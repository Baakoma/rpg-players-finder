<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileSystemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'system_id' => $this->system_id,
            'name' => $this->system->name,
            'lore_knowledge_rating' => $this->lore_knowledge_rating,
            'mechanic_knowledge_rating' => $this->mechanic_knowledge_rating,
            'roleplay_rating' => $this->roleplay_rating,
            'experience' => $this->experience
        ];
    }
}
