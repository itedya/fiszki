<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $user = User::where("email", $data['email'])
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'email' => ['Użytkownik z takimi danymi nie istnieje!']
            ], 422);
        }

        $tokenData = $user->createToken('auth', []);

        return response()->json([
            'token' => $tokenData->plainTextToken,
            'expires_at' => $tokenData->accessToken->expires_at
        ]);
    }

    public function register(RegisterRequest $request): User
    {
        $data = $request->validated();

        $user = new User();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();

        return $user;
    }

    public function revoke(): \Illuminate\Http\Response
    {
        $user = auth()->user();
        $user->tokens()->delete();

        return response()->noContent();
    }

    public function user(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return auth()->user();
    }
}
