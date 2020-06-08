<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'data_type' => $this->getDataType(),
            'data' => [
                'id' => $this->data->id,
                'message' => $this->data->message,
                'is_handled' => $this->when(!$this->data instanceof Message, $this->isHandled($this->data->status)),
            ],
            'created_at' => $this->created_at,
        ];
    }

    private function isHandled($value): bool
    {
        return $value != 0;
    }
}
