<?php

declare(strict_types=1);

namespace AppointmentService\Auth;

use AppointmentService\Auth\View\Components\AppLayout;
use AppointmentService\Auth\View\Components\GuestLayout;
use AppointmentService\Common\Providers\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
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

        $this->registerComponents()
            ->configureResetPassword();
    }

    private function registerComponents(): self
    {
        Blade::component('app-layout', AppLayout::class);
        Blade::component('guest-layout', GuestLayout::class);

        return $this;
    }

    private function configureResetPassword(): self
    {
        ResetPassword::createUrlUsing(fn (object $notifiable, string $token) => (
            config('app.frontend_url').url()->query("/password-reset/{$token}", [
                'email' => $notifiable->getEmailForPasswordReset(),
            ])
        ));

        return $this;
    }
}
