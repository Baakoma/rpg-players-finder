<?php

namespace App\Policies;

use App\Models\{User, Profile};
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->isAdmin()){
            return true;
        }
    }

    public function view(User $user, Profile $profile) : bool
    {
        return $user->is(User::findOrFail($profile->id)) || $user->ownerEvents->count() > 0;
    }

    public function createOrModify(User $user, Profile $profile) : bool
    {
        return $user->is(User::findOrFail($profile->id));
    }
}
