<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Resources\Appointment;

use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Facades\Str;
use Carbon\WeekDay;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\Color;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

#[Icon('wrench-screwdriver')]
final class ConfigurationAvailabilitySlotResource extends ModelResource
{
    protected string $model = ConfigurationAvailabilitySlot::class;

    protected string $column = 'id';

    protected array $with = ['appointmentConfiguration'];

    public function getTitle(): string
    {
        return Str::singular(__('moonshine::ui.resource.module.appointment.configuration_availability_slot_title'));
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
                'Appointment Configuration',
                'appointmentConfiguration',
                resource: AppointmentConfigurationResource::class,
            )
                ->badge(Color::PURPLE)
                ->searchable()
                ->required(),

            Select::make('Day of week')
                ->options([
                    WeekDay::int(WeekDay::Monday) => 'Monday',
                    WeekDay::int(WeekDay::Tuesday) => 'Tuesday',
                    WeekDay::int(WeekDay::Wednesday) => 'Wednesday',
                    WeekDay::int(WeekDay::Thursday) => 'Thursday',
                    WeekDay::int(WeekDay::Friday) => 'Friday',
                    WeekDay::int(WeekDay::Saturday) => 'Saturday',
                    WeekDay::int(WeekDay::Sunday) => 'Sunday',
                ])
                ->searchable(),

            Text::make('Start Time')
                ->required(),

            Text::make('End Time')
                ->required(),

            Date::make('Date')
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
