<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;


class Role
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == User::admin) {
            return $next($request);
        }
    }
}
