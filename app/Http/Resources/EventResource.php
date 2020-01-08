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
            'is_active' => $this->is_active,
            'types' => TypeResource::collection($this->types),
            'invitations' => InvitationResource::collection($this->invitation),
        ];
    }
}
