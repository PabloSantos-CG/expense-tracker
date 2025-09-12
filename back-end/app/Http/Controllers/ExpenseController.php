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
            'message' => 'expense created',
            'data' => $expense,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
