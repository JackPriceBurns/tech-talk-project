<?php

namespace App\Events;

use App\Http\Resources\PhotoResource;
use App\Models\Photo;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PhotoUploaded implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /** @var string */
    public $photo;

    /**
     * PhotoUploaded constructor.
     *
     * @param Photo $photo
     */
    public function __construct(Photo $photo)
    {
        $this->photo = json_encode(PhotoResource::make($photo));
    }

    /**
     * @return string[]
     */
    public function broadcastOn(): array
    {
        return ['main-channel'];
    }

    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'photo-uploaded';
    }
}
