<?php

namespace App\Events;

use App\Models\FriendsList;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FriendsListRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $friendsList;

    public function __construct(FriendsList $friendsList)
    {
        $this->friendsList = $friendsList;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
