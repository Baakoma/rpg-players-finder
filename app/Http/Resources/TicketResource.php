<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray($request): array
    {
        $ticket = $this->ticket;
        return [
            'systems' => $ticket->systems,
            'types' => $ticket->types,
            'languages' => $ticket->languages,
            'camera' => $ticket->camera,
            'description' => $ticket->description
        ];
    }
}
