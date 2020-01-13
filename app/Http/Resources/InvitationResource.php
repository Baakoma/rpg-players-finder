<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'event_id' => $this->event,
            'user_id' => $this->user,
            'accepted' => $this->accepted,
            'close' => $this->close,
            'date' => date($this->created_at),
        ];
    }
}
