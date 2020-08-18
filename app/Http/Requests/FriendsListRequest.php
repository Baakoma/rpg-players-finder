<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FriendsListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'friend_id' => 'required|numeric|exists:users,id',
            'user_id' => 'required|numeric|exists:users,id',
        ];
    }
}
