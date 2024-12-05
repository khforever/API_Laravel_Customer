<?php

namespace App\Providers;
use App\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CustomerRepositoryInterface;
use App\Repositories\CustomerRepository;
use App\Repositories\RolePermissionRepositoryInterface;
use App\Repositories\RolePermissionRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        



    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
