<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class InviteEventFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id' => 'required|numeric',
            'player_id' => 'required|numeric',
        ];
    }
}
