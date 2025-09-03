<?php

namespace App\Application\Services;

use App\Application\Services\Contracts\UserServiceInterface;
use App\Models\User;

class UserService implements UserServiceInterface
{
    /**
     * @param string[] $credentials
     */
    public function create($credentials): User
    {
        $user = new User($credentials);
        $user->save();

        return $user;
    }
}
