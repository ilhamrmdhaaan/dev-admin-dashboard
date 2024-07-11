<?php

namespace App\Providers;

use App\Interfaces\RequestVehicle\RequestVehicleInterface;
use App\Repositories\RequestVehicle\RequestVehicleRepository;
use Illuminate\Support\ServiceProvider;

class AdminServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            RequestVehicleInterface::class,
            RequestVehicleRepository::class
        );

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
