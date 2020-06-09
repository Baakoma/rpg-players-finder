<?php

declare(strict_types=1);

namespace App\Providers;

use App\Http\Resources\UserResource;
use Illuminate\Support\ServiceProvider;

class ResourceServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        UserResource::withoutWrapping();
    }
}
