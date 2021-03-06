<?php

namespace App\services;

use App\Exceptions\ApiException;
use App\Models\User;
use JWTAuth;

class AuthManager
{
    public function register(array $request): User
    {
        $request['password'] = bcrypt($request['password']);
        $user = new User($request);
        $user->save();
        $user->refresh();
        return $user;
    }

    public function login(array $input): string
    {
        if (!$token = JWTAuth::attempt($input)) {
            throw new ApiException();
        }
        return $token;
    }
}
