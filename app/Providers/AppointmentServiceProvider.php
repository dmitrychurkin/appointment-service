<?php

namespace App\Providers;

use Core\Features\Appointment\UseCase\Contracts\InputPort\Appointment;
use Core\Features\Appointment\UseCase\Interactor\AppointmentInteractor;
use Illuminate\Support\ServiceProvider;

final class AppointmentServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        Appointment::class => AppointmentInteractor::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [Appointment::class];
    }
}
