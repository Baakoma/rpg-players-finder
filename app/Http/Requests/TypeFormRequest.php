<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TypeFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
        ];
    }
}
