<?php

namespace App\Http\Controllers;

use App\Application\Admin\Contracts\AdminProfileServiceInterface;
use App\Http\Requests\UpdateAdminProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminProfileController extends Controller
{
    protected User $loggedUser;

    public function __construct(
        private AdminProfileServiceInterface $adminProfileService,
    ) {
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
        $this->loggedUser->update($attributes);

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
