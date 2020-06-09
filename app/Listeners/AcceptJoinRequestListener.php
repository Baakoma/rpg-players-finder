<?php

namespace App\Listeners;

use App\Events\AcceptJoinRequest;
use App\Models\Message;
use App\Models\Notification;

class AcceptJoinRequestListener
{
    public function handle(AcceptJoinRequest $event): void
    {
        $message = new Message([
            'message' => $event->joinRequest->event->owner->name . ' accepted JoinRequest to: ' . $event->joinRequest->event->name,
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->joinRequest->player->id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
