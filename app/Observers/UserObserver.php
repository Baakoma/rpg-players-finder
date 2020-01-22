<?php

namespace App\Observers;

use App\Models\{Profile, User};

class UserObserver
{
    public function created(User $user): void
    {
        $user->profile()->save(new Profile());
    }
}
