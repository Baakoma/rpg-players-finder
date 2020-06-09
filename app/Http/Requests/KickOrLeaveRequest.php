<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KickOrLeaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|numeric|exists:event_players,player_id',
        ];
    }
}
