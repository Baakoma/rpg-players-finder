<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;


class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == User::ROLE_ADMIN) {
            return $next($request);
        }
    }
}
