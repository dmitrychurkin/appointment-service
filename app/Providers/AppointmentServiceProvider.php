<?php

namespace App\Providers;

use Core\Features\Appointment\Contracts\AppointmentUseCase;
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
        AppointmentUseCase::class => AppointmentService::class,
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
        return [AppointmentUseCase::class];
    }
}
