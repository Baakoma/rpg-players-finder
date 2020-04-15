<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next) : Request
    {
        app()->setLocale($request->query('lang'));
        return $next($request);
    }
}
