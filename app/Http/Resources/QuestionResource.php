<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property Collection votes
 */
class QuestionResource extends JsonResource
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
            'text' => $this->text,
            'votes' => $this->whenLoaded('votes', function () {
                return $this->votes->count();
            }),
            'editable' => $this->isEditable($request),
            'voted_by_me' => $this->whenLoaded('votes', function () use ($request) {
                return $this->isVotedByMe($request);
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function isEditable(Request $request): bool
    {
        $ip = $request->ip();

        if (!$ip) {
            return false;
        }

        if ($ip === $this->ip_address) {
            return true;
        }

        return false;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    private function isVotedByMe(Request $request): bool
    {
        $ip = $request->ip();

        if (!$ip) {
            return false;
        }

        return $this->votes->contains('ip_address', $ip);
    }
}
