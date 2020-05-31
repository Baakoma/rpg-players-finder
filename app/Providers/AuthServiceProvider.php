<?php

namespace App\Providers;

use App\Models\{Event, JoinRequest, Profile, Invitation, Ticket};
use App\Policies\{EventPolicy, JoinRequestPolicy, ProfilePolicy, InvitationPolicy, TicketPolicy};
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Profile::class => ProfilePolicy::class,
        Event::class => EventPolicy::class,
        Invitation::class => InvitationPolicy::class,
        JoinRequest::class => JoinRequestPolicy::class,
        Ticket::class => TicketPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
