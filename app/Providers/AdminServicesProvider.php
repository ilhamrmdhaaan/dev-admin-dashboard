<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Interfaces\RequestDetails\RequestDetailsInterface;
use App\Interfaces\RequestVehicle\RequestVehicleInterface;
use App\Repositories\RequestDetails\RequestDetailsRepository;
use App\Repositories\RequestVehicle\RequestVehicleRepository;

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
        $this->app->bind(
            RequestDetailsInterface::class,
            RequestDetailsRepository::class
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
