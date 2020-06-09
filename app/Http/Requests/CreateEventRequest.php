<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Auth, Log};
use Illuminate\Validation\Validator;

class CreateEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:1,30',
            'description' => 'required|string',
            'owner_id' => 'required|numeric|exists:users,id',
            'max_users' => 'required|numeric|min:2|max:10',
            'public_access' => 'required|boolean',
            'type_id' => 'required|numeric|exists:types,id',
            'system_id' => 'required|numeric|exists:systems,id',
            'language_id' => 'required|numeric|exists:languages,id',
        ];
    }

    public function withValidator(Validator $validator) : void
    {
        if($validator->fails())
        {
            Log::warning('User '.Auth::id().' failed event create validation');
        }
    }
}
