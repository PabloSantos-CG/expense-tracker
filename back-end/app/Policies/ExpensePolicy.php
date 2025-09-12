<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExpensePolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Category $category): bool
    {
        return $category->is_global || $category->user_id === $user->id;
    }

    /**
     * Determine whether the user can update or delete the model.
     */
    public function manage(User $user, Expense $expense): bool
    {
        return $user->id === $expense->user_id;
    }
}
