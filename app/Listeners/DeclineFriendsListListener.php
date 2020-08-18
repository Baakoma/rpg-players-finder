<?php

namespace App\Listeners;

use App\Events\DeclineFriendsList;
use App\Models\Message;
use App\Models\Notification;

class DeclineFriendsListListener
{
    public function handle(DeclineFriendsList $event): void
    {
        $message = new Message([
            'message' => $event->friendsList->friend->name . ' has not accepted friend request',
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->friendsList->user_id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
