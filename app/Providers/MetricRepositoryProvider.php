<?php

namespace App\Providers;

use App\Repositories\EloquentMetricRepository;
use App\Repositories\MetricRepository;
use Illuminate\Support\ServiceProvider;

class MetricRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        MetricRepository::class =>
        EloquentMetricRepository::class
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
