<?php

namespace App\Http\Controllers;

use App\Events\QuestionCreated;
use App\Events\QuestionUpdated;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuestionController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return QuestionResource::collection(
            Question::with('votes')->get(),
        );
    }

    /**
     * @param Question $question
     *
     * @return QuestionResource
     */
    public function show(Question $question)
    {
        return QuestionResource::make(
            tap($question)->load('votes')
        );
    }

    /**
     * @param QuestionRequest $request
     *
     * @return QuestionResource
     */
    public function store(QuestionRequest $request)
    {
        /** @var Question $question */
        $question = Question::query()->create(
            $request->only('text', 'ip_address')
        );

        event(new QuestionCreated($question));

        return QuestionResource::make($question->load('votes'));
    }

    /**
     * @param QuestionRequest $request
     * @param Question $question
     *
     * @return QuestionResource
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question = tap($question)->update(
            $request->only('text')
        );

        event(new QuestionUpdated($question));

        return QuestionResource::make($question->load('votes'));
    }
}
