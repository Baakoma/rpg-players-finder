<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FriendsListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'friend' => $this->friend->only('id', 'name', 'email'),
        ];
    }
}
