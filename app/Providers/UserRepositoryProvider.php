<?php

namespace App\Providers;

use App\Repositories\EloquentUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        UserRepository::class => EloquentUserRepository::class
    ];
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
