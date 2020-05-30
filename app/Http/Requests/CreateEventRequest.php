<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:1,30',
            'owner_id' => 'required|numeric|exists:users,id',
            'max_users' => 'required|numeric|min:2|max:10',
            'public_access' => 'required|boolean',
            'type_id' => 'required|numeric|exists:types,id',
            'system_id' => 'required|numeric|exists:systems,id',
            'language_id' => 'required|numeric|exists:languages,id',
        ];
    }
}
