<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\{Event, JoinRequest, Profile, Invitation};
use App\Policies\{EventPolicy, JoinRequestPolicy, ProfilePolicy, InvitationPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Profile::class => ProfilePolicy::class,
        Event::class => EventPolicy::class,
        Invitation::class => InvitationPolicy::class,
        JoinRequest::class => JoinRequestPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
