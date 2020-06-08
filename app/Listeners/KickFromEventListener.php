<?php

namespace App\Listeners;

use App\Events\KickFromEvent;
use App\Models\Message;
use App\Models\Notification;

class KickFromEventListener
{
    public function handle(KickFromEvent $event): void
    {
        $message = new Message([
            'message' => 'You have been kicked out of the event : ' . $event->event->name,
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->user->id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
