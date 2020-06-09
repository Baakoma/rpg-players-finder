<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'events' => $this->events->where('is_active', '=', '1')
        ];
    }
}
