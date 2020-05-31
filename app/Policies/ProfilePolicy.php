<?php

namespace App\Policies;

use App\Models\{User, Profile};
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Profile $profile) : bool
    {
        return $user->is(User::findOrFail($profile->user_id));
    }
}
