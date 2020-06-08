<?php

namespace App\Listeners;

use App\Events\AcceptInvitation;
use App\Models\Message;
use App\Models\Notification;

class AcceptInvitationListener
{
    public function handle(AcceptInvitation $event): void
    {
        $message = new Message([
            'message' => $event->invitation->player->name . ' accepted Invitation to: ' . $event->invitation->event->name,
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->invitation->event->owner_id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
