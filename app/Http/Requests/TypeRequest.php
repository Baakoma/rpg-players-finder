<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required', Rule::unique('types', 'name')->ignore($this->type)
            ],
            'description' => 'required|string',
        ];
    }

    public function withValidator(Validator $validator) : void
    {
        if ($validator->fails())
        {
            Log::warning('User '.Auth::id().' failed type validation');
        }
    }
}
