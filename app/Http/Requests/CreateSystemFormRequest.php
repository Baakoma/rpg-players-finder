<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSystemFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:systems,name',
            'description' => 'required|string',
            'links.*.name' => 'required|string',
            'links.*.url' => 'required|string',
        ];
    }
}
