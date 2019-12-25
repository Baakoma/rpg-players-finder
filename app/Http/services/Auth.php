<?php

namespace App\services;

use App\Http\Requests\RegistrationFormRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class Auth
{
    public function register(RegistrationFormRequest $request): JsonResponse
    {
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();

        return $this->login($request);
    }

    public function login(Request $request): JsonResponse
    {
        $input = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }


    public function logout(Request $request) : JsonResponse
    {
        try {
            JWTAuth::invalidate($request->token);
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

//    public function refreshToken(): JsonResponse
//    {
//
//    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
}
