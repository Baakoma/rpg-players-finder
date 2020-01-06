<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->name,
            'max_users' => $this->max_users,
            'public_access' => $this->public_access,
            'user_event' => UserEventResource::collection($this->userEvents)
        ];
    }
}
