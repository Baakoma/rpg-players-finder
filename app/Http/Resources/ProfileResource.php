<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'sex' => $this->sex,
            'description' => $this->description,
            'languages' => $this->languages,
            'systems' => $this->systems,
            'your_events' => $this->user->event, //eventy które założył
            'events' => $this->user->players    //eventy w których uczestniczy
        ];
    }
}
