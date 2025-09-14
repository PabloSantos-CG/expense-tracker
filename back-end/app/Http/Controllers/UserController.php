<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProfilePhotoRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        /** 
         * @var array{name: string, email: string, password: string} $credentials 
         */
        $credentials = $request->validated();
        $user = User::create($credentials);

        return \response()->json([
            'status' => 'success',
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

        $user->save();

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

    public function addProfilePhoto(AddProfilePhotoRequest $request)
    {
        $imagePath = $request->file('avatar')->store('avatars', 'public');
        if (!$imagePath) return \response()->noContent(400);

        if (
            $this->loggedUser->avatar &&
            Storage::exists($this->loggedUser->avatar)
        ) {
            Storage::delete($this->loggedUser->avatar);
            $this->loggedUser->avatar = null;
        }

        $this->loggedUser->avatar = $imagePath;
        $this->loggedUser->save();

        return \response()->json([
            'status' => 'success',
            'avatar_url' => \asset('storage/' . $imagePath),
        ]);
    }

    public function removeProfilePhoto()
    {
        if (!Storage::exists($this->loggedUser->avatar)) {
            return \response()->json([
                'status' => 'error',
                'message' => 'image not found',
            ], 404);
        }

        $isDeleted = Storage::delete($this->loggedUser->avatar);
        if (!$isDeleted) return \response()->noContent(400);

        $this->loggedUser->avatar = null;
        $this->loggedUser->save();

        return \response()->noContent();
    }
}
