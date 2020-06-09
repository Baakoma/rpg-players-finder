<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcceptedFriendsListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'friend' => $this->when($this->isAccepted(), $this->friend->only('id', 'name', 'email')),
        ];
    }
}
