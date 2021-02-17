<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'text' => 'required|max:255',
            'ip_address' => 'required|ip'
        ];
    }
}
