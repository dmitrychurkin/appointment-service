<?php

declare(strict_types=1);

namespace AppointmentService\Auth;

use AppointmentService\Auth\View\Components\AppLayout;
use AppointmentService\Auth\View\Components\GuestLayout;
use AppointmentService\Common\Providers\ServiceProvider;
use Illuminate\Support\Facades\Blade;

final class AuthServiceProvider extends ServiceProvider
{
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
        $this->publishesMigrations([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'auth-migrations');

        Blade::component('app-layout', AppLayout::class);
        Blade::component('guest-layout', GuestLayout::class);
    }
}
