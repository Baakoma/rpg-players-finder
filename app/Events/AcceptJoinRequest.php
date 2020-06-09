<?php

namespace App\Events;

use App\Models\JoinRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AcceptJoinRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $joinRequest;

    public function __construct(JoinRequest $joinRequest)
    {
        $this->joinRequest = $joinRequest;
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
