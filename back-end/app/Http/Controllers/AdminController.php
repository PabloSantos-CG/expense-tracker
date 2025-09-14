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

    /**
     * Mostra todos os usuários.
     */
    public function index()
    {
        $users = User::withTrashed()->paginate(10);

        return response()->json([
            'status' => 'success',
            'current_page' => $users->currentPage(),
            'per_page' => $users->perPage(),
            'total' => $users->total(),
            'last_page' => $users->lastPage(),
            'prev_page_url' => $users->previousPageUrl(),
            'next_page_url' => $users->nextPageUrl(),
            'data' => $users->items(),
        ]);
    }

    /**
     * Mostra informações de um usuário específico.
     */
    public function showUser(User $user)
    {
        return \response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    /**
     * Marca o atributo is_admin como TRUE, tornando o usuário um admin.
     */
    public function toggleAdmin(User $user)
    {
        $user->is_admin = !$user->is_admin;
        $user->save();

        return \response()->json([
            'status' => 'success',
            'data' => $user,
        ]);
    }

    /**
     * Softdelete para um usuário específico.
     */
    public function destroyUser(User $user)
    {
        if ($user->trashed()) {
            $user->forceDelete();
        } else {
            $user->delete();
        }

        return \response()->noContent();
    }

    public function recoverDeletedUser(User $user)
    {
        if ($user->trashed()) {
            $user->restore();

            return \response()->json([
                'status' => 'success',
                'data' => $user
            ]);
        }

        return \response()->noContent();
    }
}
