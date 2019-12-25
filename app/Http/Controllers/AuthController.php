<?php

namespace App\Http\Controllers;

use App\services\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationFormRequest;


class AuthController extends Controller
{
    public function register(RegistrationFormRequest $request, Auth $auth): JsonResponse
    {
        return $auth->register($request);
    }

    public function login(Request $request, Auth $auth): JsonResponse
    {
        return $auth->login($request);
    }

    public function logout(Request $request, Auth $auth): JsonResponse
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        return $auth->logout($request);
    }

//    public function refresh(Auth $auth): JsonResponse
//    {
//        return $auth->refreshToken();
//    }

}
