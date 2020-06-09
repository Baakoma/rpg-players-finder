<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Auth, Log};
use Illuminate\Validation\Validator;

class UpdateTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }

    public function withValidator(Validator $validator) : void
    {
        if($validator->fails())
        {
            Log::warning('User '.Auth::id().' failed type update validation');
        }
    }
}
