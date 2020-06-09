<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyEventsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'events' => $this->ownerEvents->where('is_active', '=', '0')
        ];
    }
}
