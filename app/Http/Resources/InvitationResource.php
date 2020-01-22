<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'event' => $this->event,
            'player' => $this->player,
            'accepted' => $this->accepted,
            'close' => $this->close,
            'date' => $this->created_at
        ];
    }
}
