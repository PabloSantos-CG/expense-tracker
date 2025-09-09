<?php

namespace App\Services;

use App\Services\Contracts\LogoutServiceInterface;
use Illuminate\Support\Facades\Auth;

class LogoutService implements LogoutServiceInterface
{
    public function execute(): void
    {
        Auth::logout();
    }
}
