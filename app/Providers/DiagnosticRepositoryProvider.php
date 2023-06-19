<?php

namespace App\Providers;

use App\Repositories\DiagnosticRepository;
use App\Repositories\EloquentDiagnosticRepository;
use Illuminate\Support\ServiceProvider;

class DiagnosticRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        DiagnosticRepository::class =>
        EloquentDiagnosticRepository::class
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
