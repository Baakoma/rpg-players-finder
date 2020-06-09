<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\{Auth, Log};

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /** @throws ValidationException */
    public function login(LoginRequest $request)
    {
        if (!$this->attemptLogin($request)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
        Log::info('User '.Auth::id().' logged in');
    }

    private function attemptLogin(LoginRequest $request): bool
    {
        return $this->guard()->attempt($request->only('email', 'password'));
    }

    private function guard(): StatefulGuard
    {
        return Auth::guard();
    }
}
