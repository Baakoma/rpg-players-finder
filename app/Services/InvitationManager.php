<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Invitation;

class InvitationManager
{
    public function create(array $data): Invitation
    {
        $event = Event::query()->findOrFail($data['event_id']);
        if ($event->playerExist($data['player_id'])) {
            abort(400, 'You cannot create the invitation');
        }
        $invitation = new Invitation($data);
        $invitation->save();
        $invitation->refresh();
        return $invitation;
    }

    public function accept(Invitation $invitation): Invitation
    {
        $event = $invitation->event;
        if (!$event->canAccess($invitation->player)) {
            abort(400, 'You cannot accept the invitation');
        }
        $event->players()->attach($invitation->player);
        $invitation->acceptInvitation();
        return $invitation;
    }

    public function decline(Invitation $invitation): Invitation
    {
        $invitation->declineInvitation();
        return $invitation;
    }

    public function close(Invitation $invitation): Invitation
    {
        $invitation->closeInvitation();
        return $invitation;
    }
}
