<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn(Request $req) => ["pong" => true]);

Route::post('/user/login', [AuthController::class, 'logIn']);
Route::post('/user/logout', [AuthController::class, 'logOut'])->middleware('auth');

Route::middleware('auth')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/users', 'index');
        Route::post('/user', 'store');
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
