<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn(Request $req) => ["pong" => true]);

Route::post('/users/login', [AuthController::class, 'logIn']);
Route::post('/users/logout', [AuthController::class, 'logOut']);

Route::post('/users', [UserController::class, 'store']);

Route::middleware('auth')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/users/profile', 'show');
        Route::put('/users/profile', 'update');
        Route::delete('/users/profile', 'destroy');
    });

Route::middleware(['auth', CheckAdmin::class])
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/admin/users', 'index');
        Route::get('/admin/users/{user}', 'showUser')->withTrashed();
        Route::put('/admin/users/{user}/toggle-admin', 'toggleAdmin');
        Route::delete('/admin/users/{user}', 'destroyUser')->withTrashed();
        Route::put('/admin/users/{user}/recover', 'recoverDeletedUser')
            ->withTrashed();
    });

Route::middleware('auth')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/categories', 'index');
        Route::post('/categories', 'store');
        Route::get('/categories/{category}/expenses', 'show');
        Route::put('/categories/{category}', 'update');
        Route::delete('/categories/{category}', 'destroy');
    });

Route::middleware('auth')
    ->controller(ExpenseController::class)
    ->group(function () {
        Route::get('/categories/expenses', 'index');
        Route::post('/categories/expenses', 'store');
        Route::get('/categories/expenses/{expense}', 'show');
        Route::put('/categories/expenses/{expense}', 'update');
        Route::delete('/categories/expenses/{expense}', 'destroy');
    });
