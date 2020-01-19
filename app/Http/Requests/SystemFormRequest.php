<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SystemFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required', Rule::unique('systems', 'name')->ignore($this->system)
            ],
            'description' => 'required|string',
            'links.*.name' => 'required|string',
            'links.*.url' => 'required|string',
        ];
    }
}
