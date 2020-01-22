<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LogoutFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => 'required|string'
        ];
    }
}
