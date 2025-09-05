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

Route::post('/user/login', [AuthController::class, 'logIn']);
Route::post('/user/logout', [AuthController::class, 'logOut']);

Route::post('/user', [UserController::class, 'store']);

Route::middleware(['auth', CheckAdmin::class])
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/admin/profile', 'showProfile');
        Route::put('/admin/profile', 'updateProfile');
        Route::delete('/admin/profile', 'destroyAccount');

        Route::get('/admin/users', 'index');
        Route::get('/admin/user/{id}', 'showUser');
        Route::put('/admin/user/{id}/make-admin', 'makeAdmin');
        Route::delete('/admin/user/{id}', 'destroyUser');
    });

Route::middleware('auth')
    ->controller(UserController::class)
    ->group(function () {
        // adicionar política para verificar se ta pegando informação dele mesmo
        Route::get('/user/{id}', 'show');
        Route::put('/user/{id}', 'update');
        Route::delete('/user/{id}', 'destroy');
    });

Route::middleware('auth')
    ->controller(CategoryController::class)
    ->group(function () {
        Route::get('/categories', 'index');
        Route::post('/category', 'store');
        Route::get('/category/{id}', 'show');
        Route::put('/category/{id}', 'update');
        Route::delete('/category/{id}', 'destroy');
    });

Route::middleware('auth')
    ->controller(ExpenseController::class)
    ->group(function () {
        Route::get('/category/expenses', 'index');
        Route::post('/category/expense', 'store');
        Route::get('/category/expense/{id}', 'show');
        Route::put('/category/expense/{id}', 'update');
        Route::delete('/category/expense/{id}', 'destroy');
    });
