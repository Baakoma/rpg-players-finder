<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'birth_date' => 'date_format:d-m-Y|before:', //getdate()?
            'description' => 'string|max:255',
        ];
    }
}
