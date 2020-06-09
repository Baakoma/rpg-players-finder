<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsHistoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'myEvents' => $this->ownerEvents->where('is_active', '=', '0'),
            'events' => $this->events->where('is_active', '=', '0')
        ];
    }
}
