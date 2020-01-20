<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\LogoutFormRequest;
use App\Http\Resources\UserResource;
use App\services\AuthManager;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function register(RegistrationFormRequest $request, AuthManager $auth): JsonResource
    {
        $user = $auth->register($request->only('name', 'email', 'password'));

        return new UserResource($user);
    }

    public function login(LoginFormRequest $request, AuthManager $auth): JsonResponse
    {
        try {
            $token = $auth->login($request->only('email', 'password'));

            return response()->json([
                'success' => true,
                'token' => $token,
            ]);
        } catch (ApiException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function logout(LogoutFormRequest $request): JsonResponse
    {
        try {
            JWTAuth::invalidate($request->only('token'));

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
}
