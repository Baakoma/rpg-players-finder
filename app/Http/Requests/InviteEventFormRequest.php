<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class InviteEventFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'event_id' => 'required|numeric',
            'user_id' => 'required|numeric',
        ];
    }
}
