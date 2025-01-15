<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Layouts;

use AppointmentService\Administration\Resources\Appointment\AccountResource;
use AppointmentService\Administration\Resources\Appointment\AppointmentConfigurationResource;
use AppointmentService\Administration\Resources\Appointment\AppointmentResource;
use AppointmentService\Administration\Resources\Appointment\ConfigurationAvailabilitySlotResource;
use AppointmentService\Administration\Resources\Appointment\UserResource;
use AppointmentService\Administration\Resources\System\SystemUserResource;
use AppointmentService\Administration\Resources\System\UserRoleResource;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\Layout\Layout;

final class DashboardLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make(static fn () => __('moonshine::ui.resource.system'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.admins_title'),
                    SystemUserResource::class
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.role_title'),
                    UserRoleResource::class
                ),
            ]),
            MenuGroup::make(static fn () => __('moonshine::ui.resource.module.appointment.name'), [
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.module.appointment.user_title'),
                    UserResource::class
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.module.appointment.account_title'),
                    AccountResource::class
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.module.appointment.appointment_title'),
                    AppointmentResource::class
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.module.appointment.appointment_configuration_title'),
                    AppointmentConfigurationResource::class
                ),
                MenuItem::make(
                    static fn () => __('moonshine::ui.resource.module.appointment.configuration_availability_slot_title'),
                    ConfigurationAvailabilitySlotResource::class
                ),
            ]),
        ];
    }

    /**
     * @param  ColorManager  $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
