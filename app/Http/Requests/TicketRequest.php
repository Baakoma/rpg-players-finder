<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function rules()
    {
        return [
            'systems.*' => 'required|numeric|exists:systems,id',
            'types.*' => 'required|numeric|exists:types,id',
            'languages.*' => 'required|numeric|exists:languages,id',
            'camera' => 'required|boolean',
            'description' => 'string|max:500|nullable',
        ];
    }
}
