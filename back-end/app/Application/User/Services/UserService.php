<?php

namespace App\Application\User\Services;

use App\Application\User\Contracts\UserServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    protected User $loggedUser;

    public function __construct() {
        $this->loggedUser = Auth::user();
    }

    public function all() {
        
    }

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
