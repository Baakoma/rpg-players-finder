<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTypeFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:types,name',
            'description' => 'required|string',
        ];
    }
}
