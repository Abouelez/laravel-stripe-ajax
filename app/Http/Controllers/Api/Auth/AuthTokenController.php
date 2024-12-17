<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthTokenController extends Controller
{
    function login(LoginRequest $request)
    {
        $request->authenticate();

        $user = User::find(Auth::user()['id']);
        $device = substr($request->userAgent() ?? '', 0, 255);
        $token = $user->createToken($device)->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);
    }

    function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->noContent();
    }
}
