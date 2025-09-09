<?php

namespace App\Http\Controllers;

use App\Application\Admin\Contracts\AdminServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected User $loggedUser;

    public function __construct(
        private AdminServiceInterface $adminService,
    ) {
        $this->loggedUser = Auth::user();
    }

    /**
     * Mostra todos os usuários.
     */
    public function index()
    {
        $users = User::withTrashed()->get();

        return \response()->json([
            'status' => 'success',
            'data' => $users
        ]);
    }

    /**
     * Mostra informações de um usuário específico.
     */
    public function showUser(User $user)
    {
        //
    }

    /**
     * Marca o atributo is_admin como TRUE, tornando o usuário um admin.
     */
    public function makeAdmin(User $user)
    {
        //
    }

    /**
     * Softdelete para um usuário específico.
     */
    public function destroyUser(User $user)
    {
        //
    }
}
