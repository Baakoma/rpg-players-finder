<?php

namespace App\Services;

use App\Models\Invitation;

class InvitationManager
{
    public function creatInvitation(int $eventId, int $userId): Invitation
    {
        $invitation = new Invitation(['event_id' => $eventId, 'user_id' => $userId]);
        $invitation->save();
        return $invitation;
    }

    public function deleteInvitation(Invitation $invitation): Invitation
    {
        $invitation->delete();
        return $invitation;
    }
}
