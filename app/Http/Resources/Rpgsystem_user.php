<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Rpgsystem_user extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => Rpgsystem::collection($this->rpgsystems),
            'lore_knowledge_rating' => $this->lore_knowledge_rating,
            'mechanic_knowledge_rating' => $this->mechanic_knowledge_rating,
            'roleplay_rating' => $this->roleplay_rating,
        ];
    }
}
