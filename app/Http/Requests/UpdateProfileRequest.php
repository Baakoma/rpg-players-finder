<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:1,20',
            'birth_date' => 'required|date_format:Y-m-d|before:today',
            'description' => 'string|max:255|nullable',
            'languages.*.id' => 'required|numeric|exists:languages,id',
            'systems.*.system_id' => 'required|numeric|exists:systems,id',
            'systems.*.lore_knowledge_rating' => 'required|numeric|min:0|max:10',
            'systems.*.mechanic_knowledge_rating' => 'required|numeric|min:0|max:10',
            'systems.*.roleplay_rating' => 'required|numeric|min:0|max:10',
            'systems.*.experience' => 'required|numeric|min:0|max:10'
        ];
    }
}
