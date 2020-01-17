<?php

namespace App\Services;

use App\Exceptions\ApiException;
use App\Models\Invitation;

class InvitationManager
{
    public function creatInvitation(array $invitationData): Invitation
    {
        $invitation = new Invitation($invitationData);
        $invitation->save();
        return $invitation;
    }

    public function acceptInvitation(Invitation $invitation): Invitation
    {
        $event = $invitation->event;
        if ($event->canAccess()) {
            $event->players()->attach($invitation->user);
            $invitation->accept();
            return $invitation;
        } else {
            throw new ApiException();
        }
    }

    public function deleteInvitation(Invitation $invitation): Invitation
    {
        $invitation->delete();
        return $invitation;
    }
}
