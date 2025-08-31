<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $cred = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (! $token = auth('api')->attempt($cred)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function logout()
    {
        auth('api')->logout(); // blacklist current token (ถ้าเปิด blacklisting)
        return response()->json(['message' => 'Logged out']);
    }

    protected function respondWithToken(string $token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60, // seconds
            'user'         => auth('api')->user(),
        ]);
    }
}