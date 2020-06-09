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
            'name' => $this->user->name,
            'age' => Carbon::parse($this->birth_date)->age,
            'birth_date' => $this->birth_date,
            'sex' => $this->sex,
            'camera' => $this->camera,
            'discord' => $this->discord,
            'description' => $this->description,
            'languages' => $this->languages->pluck('pivot.language_id'),
            'systems' => $this->systems->pluck('pivot.system_id'),
            'types' => $this->types->pluck('pivot.type_id'),
        ];
    }
}
