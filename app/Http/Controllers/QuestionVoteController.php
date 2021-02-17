<?php

namespace App\Http\Controllers;

use App\Events\QuestionUpdated;
use App\Http\Requests\QuestionVoteRequest;
use App\Models\Question;
use Illuminate\Http\JsonResponse;

class QuestionVoteController extends Controller
{
    /**
     * @param QuestionVoteRequest $request
     * @param Question $question
     *
     * @return JsonResponse
     */
    public function store(QuestionVoteRequest $request, Question $question)
    {
        $request->get('positive_vote')
            ? $question->votes()->create($request->only('ip_address'))
            : $question->votes()->where('ip_address', $request->ip_address)->delete();

        event(new QuestionUpdated($question));

        return response()->json(['message' => 'Success']);
    }
}
