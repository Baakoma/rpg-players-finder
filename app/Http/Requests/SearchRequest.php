<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'systems' => 'exists:systems,id',
            'types' => 'exists:types,id',
            'languages' => 'exists:languages,id',
            'camera' => 'boolean',
            'age.min' => 'numeric',
            'age.max' => 'numeric',
            'orderBy' => 'string',
            'sortBy' => 'string',
            'perPage' => 'numeric',
            'page' => 'numeric',
        ];
    }
}
