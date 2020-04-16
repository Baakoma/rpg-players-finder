<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'systems' => '',
            'types' => '',
            'languages' => '',
            'camera' => '',
            'age' => '',
            'orderBy' => '',
            'sortBy' => '',
            'perPage' => '',
            'page' => '',
        ];
    }
}
