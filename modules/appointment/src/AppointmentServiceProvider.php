<?php

declare(strict_types=1);

namespace AppointmentService\Appointment;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Contracts\Services\Appointment;
use AppointmentService\Appointment\Repositories\AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Services\AppointmentService;
use AppointmentService\Common\Providers\ServiceProvider;

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
        $this->mergeConfigFrom(
            __DIR__.'/../config/appointment.php',
            'appointment'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/appointment.php' => config_path('appointment.php'),
        ], 'appointment-config');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'appointment-migrations');
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
