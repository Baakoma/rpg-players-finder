<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Invitation;

class InvitationManager
{
    public function creatInvitation(array $invitationData): Invitation
    {
        $event = Event::query()->findOrFail($invitationData['event_id']);
        if ($event->playerExist($invitationData['player_id'])) {
            abort(400, 'You cannot create the invitation');
        }
        $invitation = new Invitation($invitationData);
        $invitation->save();
        $invitation->refresh();
        return $invitation;
    }

    public function acceptInvitation(Invitation $invitation): Invitation
    {
        $event = $invitation->event;
        if (!$event->canAccess($invitation->player)) {
            abort(400, 'You cannot accept the invitation');
        }
        $event->players()->attach($invitation->player);
        $invitation->acceptInvitation();
        return $invitation;
    }

    public function declineInvitation(Invitation $invitation): Invitation
    {
        $invitation->declineInvitation();
        return $invitation;
    }

    public function deleteInvitation(Invitation $invitation): Invitation
    {
        $invitation->delete();
        return $invitation;
    }
}
