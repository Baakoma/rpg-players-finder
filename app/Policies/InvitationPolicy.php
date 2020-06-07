<?php

namespace App\Policies;

use App\Http\Requests\InviteEventRequest;
use App\Models\{Event, Invitation, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Invitation $invitation) : bool
    {
        return $user->is(User::findOrFail($invitation->player_id))  || $user->is(User::findOrFail($invitation->event->owner_id));
    }

    public function create(User $user, InviteEventRequest $request) : bool
    {
        $event = Event::findOrFail($request->event_id);
        return $user->is(User::findOrFail($event->owner_id));
    }

    public function delete(User $user, Invitation $invitation) : bool
    {
        return $user->is(User::findOrFail($invitation->event->owner_id));
    }

    public function acceptOrDecline(User $user, Invitation $invitation) : bool
    {
        return $user->is(User::findOrFail($invitation->player_id));
    }

    public function close(User $user, Invitation $invitation) : bool
    {
        return $user->is(User::findOrFail($invitation->event->owner_id));
    }
}
