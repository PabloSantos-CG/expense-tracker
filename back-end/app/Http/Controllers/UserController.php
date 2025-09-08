<?php

namespace App\Http\Controllers;

use App\Application\Services\Contracts\UserServiceInterface;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;


class UserController extends Controller
{
    
    public function __construct(
        private UserServiceInterface $userService
    ) {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $credentials = $request->only(['name', 'email', 'password']);

        $user = $this->userService->create($credentials);

        return \response()->json([
            'status' => 'success',
            'message' => 'user created',
            'data' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Só vai deletar se o usuário autenticado for igual ao usuário solicitado para delete

        
    }
}
