<?php

namespace App\Services;

use App\Exceptions\ApiException;
use App\Models\Event;
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
        $event = Event::query()->findOrFail($invitation->event_id);
        if ($event->canAccess()) {
            $event->users()->attach($invitation->user_id);
            $invitation->accept();
            return $invitation;
        }else{
            throw new ApiException();
        }
    }

    public function deleteInvitation(Invitation $invitation): Invitation
    {
        $invitation->delete();
        return $invitation;
    }
}
