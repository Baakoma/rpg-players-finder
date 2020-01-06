<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CreateEventFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|between:1,30',
            'user_id' => 'required|integer|unique:events',
            'max_users' => 'required|integer',
            'public_access' => 'required|boolean',
        ];
    }
}
