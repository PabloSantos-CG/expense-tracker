<?php

namespace App\Providers;

use App\Application\Admin\Contracts\AdminProfileServiceInterface;
use App\Application\Admin\Contracts\AdminServiceInterface;
use App\Application\Admin\Services\AdminService;
use App\Application\Auth\Contracts\LoginServiceInterface;
use App\Application\Auth\Contracts\LogoutServiceInterface;
use App\Application\Auth\Services\LoginService;
use App\Application\Auth\Services\LogoutService;
use App\Application\Category\Contracts\CategoryServiceInterface;
use App\Application\Category\Services\CategoryService;
use App\Application\Expense\Contracts\ExpenseServiceInterface;
use App\Application\Expense\Services\ExpenseService;
use App\Application\User\Contracts\UserServiceInterface;
use App\Application\User\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
        $this->app->bind(LogoutServiceInterface::class, LogoutService::class);
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(AdminProfileServiceInterface::class, AdminService::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(ExpenseServiceInterface::class, ExpenseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
