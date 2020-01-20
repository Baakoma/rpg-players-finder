<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        $today = date("Y-m-d");
        $diff = date_diff(date_create($this->birth_date), date_create($today))->format('%y');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $diff,
            'sex' => $this->sex,
            'description' => $this->description,
            'languages' => $this->languages,
            'systems' => $this->systems,
            'your_events' => $this->user->event, //eventy które założył
            'events' => $this->user->players    //eventy w których uczestniczy
        ];
    }
}
