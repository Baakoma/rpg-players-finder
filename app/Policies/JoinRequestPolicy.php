<?php

namespace App\Policies;

use App\Http\Requests\JoinRequestEventFormRequest;
use Illuminate\Support\Collection;
use App\Models\{User, JoinRequest};
use Illuminate\Auth\Access\HandlesAuthorization;

class JoinRequestPolicy
{
    use HandlesAuthorization;

    public function view(User $user, JoinRequest $joinRequest) : bool
    {
        $owner = new Collection($user->ownerEvents->pluck('id'));
        return $user->is(User::findOrFail($joinRequest->player_id)) || $owner->contains($joinRequest->event_id);
    }

    public function create(User $user, JoinRequestEventFormRequest $request) : bool
    {
        return $user->is(User::findOrFail($request->player_id));
    }

    public function acceptOrDecline(User $user, JoinRequest $joinRequest) : bool
    {
        $owner = new Collection($user->ownerEvents->pluck('id'));
        return $owner->contains($joinRequest->event_id);
    }

    public function close(User $user, JoinRequest $joinRequest) : bool
    {
        return $user->is(User::findOrFail($joinRequest->player_id));
    }

    public function delete(User $user, JoinRequest $joinRequest) : bool
    {
        return $user->is(User::findOrFail($joinRequest->player_id));
    }
}
