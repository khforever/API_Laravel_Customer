<?php

namespace App\Providers;
use App\Interfaces\AuthRepositoryInterface;
use App\Repositories\AuthRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CustomerRepositoryInterface;
use App\Repositories\CustomerRepository;

use App\Models\User;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        // $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
