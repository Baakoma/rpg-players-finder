<?php

namespace App\Listeners;

use App\Events\FriendsListRequest;
use App\Models\Message;
use App\Models\Notification;

class FriendsListRequestListener
{
    public function handle(FriendsListRequest $event): void
    {
        $message = new Message([
            'message' => 'You have been invited by ' . $event->friendsList->user->name . ' to your friends list',
        ]);
        $message->save();
        $message->notification()->save(new Notification([
            'user_id' => $event->friendsList->friend_id,
            'data_id' => $message->id,
            'date_type' => Message::class
        ]));
    }
}
