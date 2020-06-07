<?php

namespace App\Observers;

use App\Models\Invitation;
use App\Models\Notification;

class InvitationObserver
{
    public function created(Invitation $invitation): void
    {
        $invitation->notification()->save(new Notification());
    }
}
