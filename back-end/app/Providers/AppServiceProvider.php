<?php

namespace App\Providers;


// use App\Application\Category\Contracts\CategoryServiceInterface;
// use App\Application\Category\Services\CategoryService;
// use App\Application\Expense\Contracts\ExpenseServiceInterface;
// use App\Application\Expense\Services\ExpenseService;

use App\Services\Contracts\LoginServiceInterface;
use App\Services\Contracts\LogoutServiceInterface;
use App\Services\LoginService;
use App\Services\LogoutService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(LogoutServiceInterface::class, LogoutService::class);
        // $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        // $this->app->bind(ExpenseServiceInterface::class, ExpenseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
