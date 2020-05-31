<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LogoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => 'required|string'
        ];
    }
}