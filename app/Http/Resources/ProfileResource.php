<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        $age = Carbon::parse($this->birth_date)->age;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $age,
            'sex' => $this->sex,
            'description' => $this->description,
            'languages' => $this->languages,
            'systems' => $this->systems,
            'your_events' => $this->user->event, //eventy które założył
            'events' => $this->user->players    //eventy w których uczestniczy
        ];
    }
}
