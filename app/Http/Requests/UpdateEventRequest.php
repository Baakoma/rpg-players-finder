<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:1,30',
            'max_users' => 'required|numeric|min:2|max:10',
            'public_access' => 'required|boolean',
            'type_id' => 'required|numeric',
        ];
    }
}
