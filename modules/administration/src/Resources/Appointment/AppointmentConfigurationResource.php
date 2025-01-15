<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Resources\Appointment;

use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Common\Facades\Str;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\Color;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;

#[Icon('wrench')]
final class AppointmentConfigurationResource extends ModelResource
{
    protected string $model = AppointmentConfiguration::class;

    protected string $column = 'id';

    protected array $with = ['account'];

    public function getTitle(): string
    {
        return Str::singular(__('moonshine::ui.resource.module.appointment.appointment_configuration_title'));
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ...$this->indexFields(),
            ]),
        ];
    }

    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make(
                'Account',
                'account',
                formatted: static fn (Account $model) => $model->slug,
                resource: AccountResource::class,
            )
                ->badge(Color::PURPLE)
                ->searchable()
                ->required(),

            HasMany::make(
                'Configuration Availability Slots',
                'configurationAvailabilitySlots',
                resource: ConfigurationAvailabilitySlotResource::class,
            )
                ->badge(Color::RED),

            Number::make('Version')
                ->readonly(),

            Number::make('Appointments per day')
                ->nullable(),

            Number::make('Next appointment threshold minutes')
                ->nullable(),

            Date::make('Created At')
                ->readonly(),

            Date::make('Updated At')
                ->readonly(),
        ];
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(Action::DELETE);
    }
}
