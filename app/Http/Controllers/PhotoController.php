<?php

namespace App\Http\Controllers;

use App\Events\PhotoUploaded;
use App\Http\Requests\PhotoStoreRequest;
use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class PhotoController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return PhotoResource::collection(Photo::query()->orderByDesc('created_at')->get());
    }

    /**
     * @return View
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * @param PhotoStoreRequest $request
     *
     * @return PhotoResource
     */
    public function store(PhotoStoreRequest $request)
    {
        // Get file info.
        $image = $request->file('file');
        $name = Uuid::uuid4()->toString();
        $path = 'photo-uploads/' . $name . '.' . $image->getClientOriginalExtension();

        /** @var Photo $photo */
        $photo = Photo::query()->create(
            [
                's3_path' => $path,
                'size' => $image->getSize(),
                'mime' => $image->getMimeType()
            ]
        );

        // Put on S3.
        Storage::disk('s3')->put($path, file_get_contents($image));

        // Fire uploaded event.
        event(new PhotoUploaded($photo));

        return PhotoResource::make($photo);
    }
}
