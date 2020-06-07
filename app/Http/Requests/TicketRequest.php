<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Auth, Log};
use Illuminate\Validation\Validator;

class TicketRequest extends FormRequest
{
    public function rules()
    {
        return [
            'systems' => 'required',
            'systems.*' => 'required|numeric|exists:systems,id',
            'types' => 'required',
            'types.*' => 'required|numeric|exists:types,id',
            'languages.*' => 'required|numeric|exists:languages,id',
            'languages' => 'required',
            'camera' => 'required|boolean',
            'description' => 'string|max:500|nullable',
        ];
    }

    public function withValidator(Validator $validator) : void
    {
        if($validator->fails())
        {
            Log::warning('User '.Auth::id().' failed ticket validation');
        }
    }
}
