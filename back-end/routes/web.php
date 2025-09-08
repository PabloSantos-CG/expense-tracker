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

Route::middleware(['auth', CheckAdmin::class])
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/admin/profile', 'showProfile');
        Route::put('/admin/profile', 'updateProfile');
        Route::delete('/admin/profile', 'destroyAccount');

        Route::get('/admin/users', 'index');
        Route::get('/admin/users/{id}', 'showUser');
        Route::put('/admin/users/{id}', 'makeAdmin');
        Route::delete('/admin/users/{id}', 'destroyUser');
    });

Route::middleware('auth')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/users', 'show');
        Route::put('/users', 'update');
        Route::delete('/users', 'destroy');
    });
Route::post('/users', [UserController::class, 'store']);

Route::middleware('auth')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/categories', 'index');
        Route::post('/categories', 'store');
        Route::get('/categories/{id}', 'show');
        Route::put('/categories/{id}', 'update');
        Route::delete('/categories/{id}', 'destroy');
    });

Route::middleware('auth')
    ->controller(ExpenseController::class)
    ->group(function () {
        Route::get('/categories/expenses', 'index');
        Route::post('/categories/expenses', 'store');
        Route::get('/categories/expenses/{id}', 'show');
        Route::put('/categories/expenses/{id}', 'update');
        Route::delete('/categories/expenses/{id}', 'destroy');
    });
