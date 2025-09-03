<?php

namespace App\Application\Services\Contracts;

use App\Models\User;

interface UserServiceInterface {
    public function create(mixed $credentials): User;
}