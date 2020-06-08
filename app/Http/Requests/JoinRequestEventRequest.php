<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Auth, Log};
use Illuminate\Validation\Validator;

class JoinRequestEventRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id' => 'required|numeric|exists:events,id',
            'player_id' => 'required|numeric|exists:users,id',
            'message' => 'required|string',
        ];
    }

    public function withValidator(Validator $validator) : void
    {
        if($validator->fails())
        {
            Log::warning('User '.Auth::id().' failed event join-request validation');
        }
    }
}
