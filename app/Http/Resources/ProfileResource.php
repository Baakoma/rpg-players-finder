<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => Carbon::parse($this->birth_date)->age,
            'sex' => $this->sex,
            'description' => $this->description,
            'languages' => $this->languages,
            'systems' => $this->systems,
            'owner_events' => $this->user->ownerEvents,
            'events' => $this->user->events
        ];
    }
}
