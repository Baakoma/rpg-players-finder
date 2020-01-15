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
            'user' => $this->user,
            'accepted' => $this->accepted,
            'close' => $this->close,
            'date' => date($this->created_at),
        ];
    }
}
