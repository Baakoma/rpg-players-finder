<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:1,20|unique:profiles,name',
            'birth_date' => 'required|date_format:d-m-Y|before:today',
            'description' => 'string|max:255|nullable',
        ];
    }
}
