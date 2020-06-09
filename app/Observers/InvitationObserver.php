<?php

namespace App\Observers;

use App\Models\Invitation;
use App\Models\Notification;

class InvitationObserver
{
    public function created(Invitation $invitation): void
    {
        $invitation->notification()->save(new Notification([
            'user_id' => $invitation->player_id,
            'data_id' => $invitation->id,
            'date_type' => Invitation::class,
        ]));
    }
}
