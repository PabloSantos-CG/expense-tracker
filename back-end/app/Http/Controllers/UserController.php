<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected User $loggedUser;

    public function __construct()
    {
        $this->loggedUser = Auth::user();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $credentials = $request->only(['name', 'email', 'password']);
        $user = User::create($credentials);

        return \response()->json([
            'status' => 'success',
            'message' => 'user created',
            'data' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return \response()->json([
            'status' => 'success',
            'data' => $this->loggedUser,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        /** 
         * @var array{
         * name?: string, 
         * email?: string, 
         * password?: string
         * } $attributes 
         */
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
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->loggedUser->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return \response()->noContent();
    }
}
