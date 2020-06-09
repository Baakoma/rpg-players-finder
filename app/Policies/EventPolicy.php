<?php

namespace App\Policies;

use App\Models\{Event, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function view(User $user, Event $event) : bool
    {
        return $event->public_access || $user->is($event->owner) || $event->playerExist($user->id);
    }

    public function modify(User $user, Event $event) : bool
    {
        return $user->is($event->owner);
    }
}
