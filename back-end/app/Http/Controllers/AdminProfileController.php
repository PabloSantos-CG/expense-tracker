<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAdminProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AdminProfileController extends Controller
{
    protected User $loggedUser;

    public function __construct()
    {
        $this->loggedUser = Auth::user();
    }

    /**
     * Mostra informações do perfil do admin.
     */
    public function showProfile()
    {
        return \response()->json([
            'status' => 'success',
            'data' => $this->loggedUser,
        ]);
    }

    /**
     * Atualiza informações do perfil do admin.
     */
    public function updateProfile(UpdateAdminProfileRequest $request)
    {
        $attributes = $request->validated();

        $user = $this->loggedUser;

        foreach ($attributes as $key => $value) {
            if ($user[$key] !== $value) $user[$key] = $value;
        }

        if ($user->isDirty()) $user->save();

        return \response()->json([
            'status' => 'success',
            'data' => $this->loggedUser
        ]);
    }

    /**
     * Softdelete na conta do admin logado.
     */
    public function destroyAccount()
    {
        //
    }
}
