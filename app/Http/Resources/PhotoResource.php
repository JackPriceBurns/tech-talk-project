<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class PhotoResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'url' => Storage::disk('s3')->temporaryUrl($this->s3_path, now()->addMinutes(5)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
