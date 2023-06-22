<?php

namespace App\Providers;

use App\Repositories\EloquentVideoRepository;
use App\Repositories\VideoRepository;
use Illuminate\Support\ServiceProvider;

class VideoRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        VideoRepository::class =>
        EloquentVideoRepository::class
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
