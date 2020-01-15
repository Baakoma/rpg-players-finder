<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;


class IsUser
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == User::ROLE_USER) {
            return $next($request);
        }
    }
}