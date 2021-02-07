<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => 'required|file|mimes:jpg,png'
        ];
    }
}
