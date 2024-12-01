<?php

namespace Core\Features\Auth;

use Core\Features\Auth\View\Components\AppLayout;
use Core\Features\Auth\View\Components\GuestLayout;
use Core\Features\Common\Providers\ServiceProvider;
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
        Blade::component('app-layout', AppLayout::class);
        Blade::component('guest-layout', GuestLayout::class);
    }
}
