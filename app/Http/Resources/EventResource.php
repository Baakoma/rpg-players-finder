<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'owner' => $this->user,
            'name' => $this->name,
            'max_users' => $this->max_users,
            'public_access' => $this->public_access,
            'is_active' => $this->is_active,
            'type_id' => $this->type,
            'event_users_count' => $this->count(),
            'event_users' => $this->users,
        ];
    }
}
