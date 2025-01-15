<?php

declare(strict_types=1);

namespace AppointmentService\Administration;

use AppointmentService\Administration\Resources\Appointment\AccountResource;
use AppointmentService\Administration\Resources\Appointment\ConfigurationAvailabilitySlotResource;
use AppointmentService\Administration\Resources\Appointment\UserResource;
use AppointmentService\Administration\Resources\System\SystemUserResource;
use AppointmentService\Administration\Resources\System\UserRoleResource;
use AppointmentService\Common\Providers\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\ConfiguratorContract;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\Providers\MoonShineServiceProvider;

final class AdministrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->register(MoonShineServiceProvider::class);
    }

    /**
     * @param  MoonShine  $core
     * @param  MoonShineConfigurator  $config
     */
    public function boot(CoreContract $core, ConfiguratorContract $config): void
    {
        // $config->authEnable();

        $core
            ->resources([
                SystemUserResource::class,
                UserRoleResource::class,
                UserResource::class,
                AccountResource::class,
                ConfigurationAvailabilitySlotResource::class,
            ])
            ->pages([
                ...$config->getPages(),
            ]);
    }
}
