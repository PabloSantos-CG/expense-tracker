<?php

namespace App\Application\Admin\Services;

use App\Application\Admin\Contracts\AdminProfileServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminProfileService implements AdminProfileServiceInterface
{
    protected User $loggedUser;

    public function __construct() {
        $this->loggedUser = Auth::user();
    }

    public function all() {
        
    }

}
