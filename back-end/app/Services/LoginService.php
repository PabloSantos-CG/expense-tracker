<?php

namespace App\Services;

use App\Services\Contracts\LoginServiceInterface;
use Illuminate\Support\Facades\Auth;

class LoginService implements LoginServiceInterface
{
    /**
     * @param string[] $credentials
     */
    public function execute(mixed $credentials): bool
    {
        if (Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }
}
