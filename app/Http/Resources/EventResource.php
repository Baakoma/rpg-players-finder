<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class EventResource extends JsonResource
{
    public function toArray($request) :array
    {
        return [
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'name'=>$this->name,
            'max_users'=>$this->max_users,
            'access'=>$this->access,
            //system
            'user_event'=>UserEventResource::collection($this->userEvents)
        ];
    }
}
