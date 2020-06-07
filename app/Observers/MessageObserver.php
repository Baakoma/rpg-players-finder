<?php

namespace App\Observers;

use App\Models\Message;
use App\Models\Notification;

class MessageObserver
{
    public function created(Message $message): void
    {
        $message->notification()->save(new Notification());
    }
}
