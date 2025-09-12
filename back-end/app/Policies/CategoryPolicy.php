<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        return $category->is_global || $category->user_id === $user->id;
    }

    /**
     * Determine whether the user can update or delete the model.
     */
    public function manage(User $user, Category $category): bool
    {
        return !$category->is_global && $category->user_id === $user->id;
    }
}
