<?php

namespace App\Events;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionCreated implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /** @var string */
    public $question;

    /**
     * QuestionCreated constructor.
     *
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = json_encode(QuestionResource::make($question));
    }

    /**
     * @return string[]
     */
    public function broadcastOn(): array
    {
        return ['main-channel'];
    }
}
