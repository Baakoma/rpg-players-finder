<?php

namespace App\Services;

use App\Models\Invitation;
use Illuminate\Validation\ValidationException;

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
        if ($event->canAccess($invitation->user)) {
            $event->players()->attach($invitation->user);
            $invitation->accept();
            return $invitation;
        } else {
            throw ValidationException::withMessages([
                'exception' => ['You cannot accept the invitation'],
            ]);
        }
    }

    public function deleteInvitation(Invitation $invitation): Invitation
    {
        $invitation->delete();
        return $invitation;
    }
}
