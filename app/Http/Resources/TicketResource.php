<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'systems' => $this->systems,
            'types' => $this->types,
            'languages' => $this->languages,
            'camera' => $this->camera,
            'description' => $this->description
        ];
    }
}
