<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEventResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'event_id' => $this->event_id,
            'user_id' => $this->user_id
        ];
    }
}