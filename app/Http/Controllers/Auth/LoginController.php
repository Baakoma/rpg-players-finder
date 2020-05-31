<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
