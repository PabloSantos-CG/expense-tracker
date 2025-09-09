<?php

namespace App\Services\Contracts;

interface LoginServiceInterface
{
    public function execute(mixed $credentials): bool;
}
