<?php

namespace App\Policies;

use App\Http\Requests\InviteEventRequest;
use App\Models\{Event, Invitation, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class InvitationPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $user, Invitation $invitation): bool
    {
        return $user->is($invitation->player)  || $user->is($invitation->event->owner);
    }

    public function create(User $user, InviteEventRequest $request): bool
    {
        $event = Event::findOrFail($request->event_id);
        return $user->is($event->owner);
    }

    public function delete(User $user, Invitation $invitation): bool
    {
        return $user->is($invitation->event->owner);
    }

    public function acceptOrDecline(User $user, Invitation $invitation): bool
    {
        return $user->is($invitation->player);
    }

    public function close(User $user, Invitation $invitation): bool
    {
        return $user->is($invitation->event->owner);
    }
}
