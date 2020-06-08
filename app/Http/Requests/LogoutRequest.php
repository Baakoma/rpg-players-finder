<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{Auth, Log};
use Illuminate\Validation\Validator;

class LogoutRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'token' => 'required|string'
        ];
    }

    public function withValidator(Validator $validator) : void
    {
        if($validator->fails())
        {
            Log::warning('User '.Auth::id().' failed logout validation');
        }
    }
}
