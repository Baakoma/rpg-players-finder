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
            'languages' => LanguageResource::collection($this->languages),
            'systems' => ProfileSystemResource::collection($this->profileSystem)
        ];
    }
}
