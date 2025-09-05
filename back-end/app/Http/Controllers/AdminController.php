<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected User $loggedUser;

    public function __construct()
    {
        $this->loggedUser = Auth::user();
    }

    // MÉTODOS APLICADOS AO PRÓPRIO USUÁRIO
    /**
     * Mostra informações do perfil do admin.
     */
    public function showProfile()
    {
        //
    }

    /**
     * Atualiza informações do perfil do admin.
     */
    public function updateProfile()
    {
        //
    }

    /**
     * Softdelete na conta do admin logado.
     */
    public function destroyAccount()
    {
        //
    }

    // MÉTODOS APLICADOS EM OUTROS USUÁRIOS
    /**
     * Mostra todos os usuários.
     */
    public function index()
    {
        //
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
