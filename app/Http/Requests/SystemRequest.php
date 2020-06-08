<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\{Rule, Validator};
use Illuminate\Support\Facades\{Auth, Log};

class SystemRequest extends FormRequest
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

    public function withValidator(Validator $validator) : void
    {
        if($validator->fails())
        {
            Log::warning('User '.Auth::id().' failed system validation');
        }
    }
}
