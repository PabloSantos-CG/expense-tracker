<?php

namespace App\Application\Auth\Services;

use App\Application\Auth\Contracts\LogoutServiceInterface;
use Illuminate\Support\Facades\Auth;

class LogoutService implements LogoutServiceInterface
{
    public function execute(): void
    {
        Auth::logout();
    }
}
