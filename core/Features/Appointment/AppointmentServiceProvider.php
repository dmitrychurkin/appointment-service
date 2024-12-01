<?php

namespace Core\Features\Appointment;

use Core\Features\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use Core\Features\Appointment\Contracts\Services\Appointment;
use Core\Features\Appointment\Repositories\AppointmentAvailabilitySlotRepository;
use Core\Features\Appointment\Services\AppointmentService;
use Illuminate\Support\ServiceProvider;

final class AppointmentServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        AppointmentAvailabilitySlot::class => AppointmentAvailabilitySlotRepository::class,
        Appointment::class => AppointmentService::class,
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
            AppointmentAvailabilitySlot::class,
        ];
    }
}
