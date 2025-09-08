<?php

namespace App\Http\Controllers;

use App\Application\Auth\Contracts\AuthServiceInterface;
use App\Application\Auth\Contracts\LoginServiceInterface;
use App\Application\Auth\Contracts\LogoutServiceInterface;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\LogoutAuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private LoginServiceInterface $loginService,
        private LogoutServiceInterface $logoutService,
    ) {}

    public function logIn(LoginAuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $isLoggedIn = $this->loginService->execute($credentials);

        if (!$isLoggedIn) {
            return \response()->json([
                'status' => 'error',
                'message' => 'login failed',
            ], 401);
        }

        $request->session()->regenerate();

        return \response()->json([
            'status' => 'success',
            'message' => 'logged in user',
        ]);
    }

    public function logOut(LogoutAuthRequest $request)
    {
        $this->logoutService->execute();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return \response()->json([
            'status' => 'success',
            'message' => 'user logged out',
        ]);
    }
}
