<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log};

class LogoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        Log::info('User '.Auth::id().' logged out');

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }

    private function guard(): StatefulGuard
    {
        return Auth::guard('web');
    }
}
