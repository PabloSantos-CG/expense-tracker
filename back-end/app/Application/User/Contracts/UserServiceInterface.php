<?php

namespace App\Application\User\Contracts;

use App\Models\User;

interface UserServiceInterface {
    public function create(mixed $credentials): User;
}