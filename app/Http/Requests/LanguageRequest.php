<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\{Rule, Validator};
use Illuminate\Support\Facades\{Auth, Log};


class LanguageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required', Rule::unique('languages', 'name')->ignore($this->language)
            ],
        ];
    }

    public function withValidator(Validator $validator) : void
    {
        if($validator->fails())
        {
            Log::warning('User '.Auth::id().' failed language validation');
        }
    }
}
