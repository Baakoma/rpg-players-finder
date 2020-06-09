<?php

namespace App\Observers;

use App\Models\JoinRequest;
use App\Models\Notification;

class JoinRequestObserver
{
    public function created(JoinRequest $joinRequest): void
    {
        $joinRequest->notification()->save(new Notification([
            'user_id' => $joinRequest->event_id,
            'data_id' => $joinRequest->id,
            'date_type' => JoinRequest::class,
        ]));
    }
}
