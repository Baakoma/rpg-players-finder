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
            'name' => 'required|string|between:1,20',
            'birth_date' => 'required|date_format:Y-m-d|before:today',
            'sex' => 'boolean|nullable',
            'camera' => 'boolean',
            'description' => 'string|max:500|nullable',
            'discord' => 'string|nullable',
            'languages.*' => 'required|numeric|exists:languages,id',
            'systems.*.id' => 'required|numeric|exists:systems,id',
            'systems.*.lore_knowledge_rating' => 'required|numeric|min:0|max:10',
            'systems.*.mechanic_knowledge_rating' => 'required|numeric|min:0|max:10',
            'systems.*.roleplay_rating' => 'required|numeric|min:0|max:10',
            'systems.*.experience' => 'required|numeric|min:0|max:10'
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
