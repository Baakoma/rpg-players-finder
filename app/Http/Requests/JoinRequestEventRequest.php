<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
}
