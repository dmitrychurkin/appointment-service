<?php

namespace App\Providers;

use Core\Features\Appointment\Domain\Contracts\AppointmentAvailabilitySlotRepository as AppointmentAvailabilitySlotRepositoryContract;
use Core\Features\Appointment\Repositories\AppointmentAvailabilitySlotRepository;
use Core\Features\Appointment\UseCase\Contracts\Appointment;
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
        AppointmentAvailabilitySlotRepositoryContract::class => AppointmentAvailabilitySlotRepository::class,
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
        return [
            Appointment::class,
            AppointmentAvailabilitySlotRepositoryContract::class,
        ];
    }
}
