<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\AcceptInvitation;
use App\Events\AcceptJoinRequest;
use App\Events\DeclineInvitation;
use App\Events\DeclineJoinRequest;
use App\Events\KickFromEvent;
use App\Events\UserLeaveFromEvent;
use App\Listeners\AcceptInvitationListener;
use App\Listeners\AcceptJoinRequestListener;
use App\Listeners\DeclineInvitationListener;
use App\Listeners\DeclineJoinRequestListener;
use App\Listeners\KickFromEventListener;
use App\Listeners\UserLeaveFromEventListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AcceptInvitation::class => [
            AcceptInvitationListener::class,
        ],
        DeclineInvitation::class => [
            DeclineInvitationListener::class,
        ],
        AcceptJoinRequest::class => [
            AcceptJoinRequestListener::class,
        ],
        DeclineJoinRequest::class => [
            DeclineJoinRequestListener::class,
        ],
        KickFromEvent::class => [
            KickFromEventListener::class,
        ],
        UserLeaveFromEvent::class => [
            UserLeaveFromEventListener::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
