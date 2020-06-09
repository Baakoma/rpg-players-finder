<?php

namespace App\Listeners;

use App\Events\UserLeaveFromEvent;
use App\Models\Message;
use App\Models\Notification;

class UserLeaveFromEventListener
{
    public function handle(UserLeaveFromEvent $event)
    {
        $message = new Message([
            'message' => 'User: ' . $event->user->name . ' left the event : ' . $event->event->name,
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->event->owner_id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
