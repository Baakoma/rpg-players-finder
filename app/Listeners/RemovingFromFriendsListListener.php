<?php

namespace App\Listeners;

use App\Events\RemovingFromFriendsList;
use App\Models\Message;
use App\Models\Notification;

class RemovingFromFriendsListListener
{
    public function handle(RemovingFromFriendsList $event): void
    {
        $message = new Message([
            'message' => 'You have been removed by ' . $event->friendsList->friend->name . ' from friends list',
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->friendsList->user_id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
