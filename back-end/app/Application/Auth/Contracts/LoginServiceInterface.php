<?php

namespace App\Application\Auth\Contracts;

interface LoginServiceInterface
{
    public function execute(mixed $credentials): bool;
}
