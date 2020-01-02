<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'mail' => $this->mail,
            'birth_date' => $this->birth_date,
            'sex' => $this->sex,
            'description' => $this->description,
            'rpgsystems' => Rpgsystem_user::collection($this->rpgsystem_user),
        ];
    }
}
