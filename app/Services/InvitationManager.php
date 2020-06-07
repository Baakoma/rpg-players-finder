<?php

namespace App\Services;

use App\Models\Event;
use App\Models\Invitation;
use Illuminate\Support\Facades\{Auth, Log};

class InvitationManager
{
    public function createInvitation(array $invitationData): Invitation
    {
        $event = Event::query()->findOrFail($invitationData['event_id']);
        if ($event->playerExist($invitationData['player_id'])) {
            abort(400, 'You cannot create the invitation');
        }
        $invitation = new Invitation($invitationData);
        $invitation->save();
        $invitation->refresh();
        Log::info('User '.Auth::id().' created invitation '.$invitation->id);
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
        Log::info('User '.Auth::id().' accepted invitation '.$invitation->id);
        return $invitation;
    }

    public function declineInvitation(Invitation $invitation): Invitation
    {
        $invitation->declineInvitation();
        Log::info('User '.Auth::id().' declined invitation '.$invitation->id);
        return $invitation;
    }

    public function deleteInvitation(Invitation $invitation): Invitation
    {
        $invitation->delete();
        Log::info('User '.Auth::id().' deleted invitation '.$invitation->id);
        return $invitation;
    }
}
