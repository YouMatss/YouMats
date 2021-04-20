<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $login = $request->validated();

        if (!Auth::attempt($login)) {
            return response(['message' => 'Invalid login credentials.']);
        }
        $user = Auth::user();
        $token = $user->createToken('authToken')->accessToken;

        return (new UserResource($user))->additional([
            'token' => $token,
        ]);
    }

    public function register(RegisterRequest $request) {
        $data = $request->validated();

        $user = User::create([
            'type' => $data['type'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);

        $user = Auth::loginUsingId($user->id);
        $token = $user->createToken('authToken')->accessToken;

        return (new UserResource($user))->additional([
            'token' => $token,
        ]);
    }

    public function reset_password() {

    }
}
