<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class InviteEventFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required|numeric',
        ];
    }
}
