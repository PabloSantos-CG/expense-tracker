<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\LogoutAuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    

    public function logIn(LoginAuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return \response()->json([
                'status' => 'success',
                'message' => 'logged in user',
            ]);
        }

        return \response()->json([
            'status' => 'error',
            'message' => 'login failed',
        ], 401);
    }

    public function logOut(LogoutAuthRequest $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return \response()->json([
            'status' => 'success',
            'message' => 'user logged out',
        ]);
    }
}
