<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return $this->sendError('The provided credentials are incorrect', 401);
        }
        $token = $user->createToken('LaravelSanctumToken')->plainTextToken;
        return $this->sendResponse(['token' => $token], 200);
    }
}
