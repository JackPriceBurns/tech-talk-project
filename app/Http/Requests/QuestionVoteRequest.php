<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionVoteRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'ip_address' => $this->ip(),
        ]);
    }

    public function rules()
    {
        return [
            'ip_address' => 'required|ip',
            'positive_vote' => 'required|boolean'
        ];
    }
}
