<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\{Invitation, JoinRequest, User};
use App\Observers\InvitationObserver;
use App\Observers\JoinRequestObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        User::observe(UserObserver::class);
        Invitation::observe(InvitationObserver::class);
        JoinRequest::observe(JoinRequestObserver::class);
    }
}
