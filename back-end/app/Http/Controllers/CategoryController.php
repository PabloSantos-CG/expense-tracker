<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        $categories = Category::where('is_global', true)
            ->orWhere('user_id', $this->loggedUser['id'])
            ->get();

        return \response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->input('title');

        if ($request->filled('is_global')) {
            $category->is_global = $request->input('is_global');
        }

        $category->user_id = $this->loggedUser['id'];
        $category->save();

        return \response()->json([
            'status' => 'success',
            'data' => $category,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load([
            'expenses' => function ($query) {
                $query->where('user_id', $this->loggedUser['id']);
            }
        ]);

        return \response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->title = $request->input('title');
        $category->save();

        return \response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->expenses()->exists()) {
            return \response()->json([
                'status' => 'error',
                'data' => 'cannot delete because there are dependencies'
            ], 409);
        }

        $category->delete();

        return \response()->noContent();
    }
}
