<?php

namespace App\Listeners;

use App\Events\DeclineJoinRequest;
use App\Models\Message;
use App\Models\Notification;

class DeclineJoinRequestListener
{
    public function handle(DeclineJoinRequest $event): void
    {
        $message = new Message([
            'message' => $event->joinRequest->event->owner->name . ' declined JoinRequest to: ' . $event->joinRequest->event->name,
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->joinRequest->player->id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
