<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    protected User $loggedUser;

    public function __construct()
    {
        $this->loggedUser = Auth::user();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::where('user_id', $this->loggedUser['id'])
            ->with('category:id,title')
            ->get();

        return \response()->json([
            'status' => 'success',
            'data' => $expenses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request, Category $category)
    {
        /** 
         * @var array{name: string, value: int|float} $attributes 
         */
        $attributes = $request->validated();
        $attributes['user_id'] = $this->loggedUser['id'];
        $attributes['category_id'] = $category->id;

        $expense = Expense::create($attributes);

        return \response()->json([
            'status' => 'success',
            'data' => $expense,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        /** 
         * @var array{name?: string, value?: int|float} $attributes 
         */
        $attributes = $request->validated();

        foreach ($attributes as $key => $value) {
            if ($expense[$key] !== $value) $expense[$key] = $value;
        }

        $expense->save();

        return \response()->json([
            'status' => 'success',
            'data' => $expense,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        if ($expense->trashed()) {
            $expense->forceDelete();
        } else {
            $expense->delete();
        }

        return \response()->noContent();
    }
}
