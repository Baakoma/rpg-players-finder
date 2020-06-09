<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Auth, Log};
use Illuminate\Validation\Validator;

class UpdateProfileRequest extends FormRequest
{
    public function rules() : array
    {
        return [
            'birth_date' => 'date_format:Y-m-d|before:today|nullable',
            'camera' => 'boolean',
            'description' => 'string|max:500|nullable',
            'discord' => 'string|nullable',
            'languages.*' => 'required|numeric|exists:languages,id',
            'systems.*' => 'required|numeric|exists:systems,id',
            'types.*' => 'required|numeric|exists:types,id',
        ];
    }

    public function withValidator(Validator $validator) : void
    {
        if($validator->fails())
        {
          Log::warning('User '.Auth::id().' failed profile validation');
        }
    }
}
