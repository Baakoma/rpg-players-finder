<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LanguageFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required', Rule::unique('languages', 'name')->ignore($this->language)
            ],
        ];
    }
}
