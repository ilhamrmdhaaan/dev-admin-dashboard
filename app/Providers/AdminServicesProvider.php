<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Dashboard\DashboardInterface;
use App\Repositories\Dashboard\DashboardRepository;
use App\Interfaces\RequestDetails\RequestDetailsInterface;
use App\Interfaces\RequestVehicle\RequestVehicleInterface;
use App\Repositories\RequestDetails\RequestDetailsRepository;
use App\Repositories\RequestVehicle\RequestVehicleRepository;
use App\Interfaces\FormRequestVehicle\FormRequestVehicleInterface;
use App\Repositories\FormRequestVehicle\FormRequestVehicleRepository;


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
        $this->app->bind(
            FormRequestVehicleInterface::class,
            FormRequestVehicleRepository::class
        );
        $this->app->bind(
            DashboardInterface::class,
            DashboardRepository::class
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
