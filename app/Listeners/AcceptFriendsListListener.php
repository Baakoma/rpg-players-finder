<?php

namespace App\Listeners;

use App\Events\AcceptFriendsList;
use App\Models\Message;
use App\Models\Notification;

class AcceptFriendsListListener
{
    public function handle(AcceptFriendsList $event): void
    {
        $message = new Message([
            'message' => $event->friendsList->friend->name . ' has accepted the friend list invitation',
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->friendsList->user_id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
