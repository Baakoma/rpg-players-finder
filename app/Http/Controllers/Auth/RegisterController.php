<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterRequest $request): void
    {
        $user = $this->create($request->only('email', 'password'));

        event(new Registered($user));

        $this->guard()->login($user);
    }

    private function guard(): StatefulGuard
    {
        return Auth::guard();
    }

    private function create(array $data): User
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
