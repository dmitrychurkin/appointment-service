<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Resources\Appointment;

use AppointmentService\Appointment\Models\Appointment\Appointment;
use AppointmentService\Appointment\Models\User\User;
use AppointmentService\Common\Facades\Str;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\Color;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

#[Icon('ticket')]
final class AppointmentResource extends ModelResource
{
    protected string $model = Appointment::class;

    protected string $column = 'id';

    protected array $with = ['user'];

    public function getTitle(): string
    {
        return Str::singular(__('moonshine::ui.resource.module.appointment.appointment_title'));
    }

    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                ...$this->indexFields(),
            ]),
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),

            ID::make('UUID', 'uuid')
                ->required()
                ->sortable()
                ->readonly(),

            Text::make('Title')
                ->required(),

            Date::make('Start')
                ->readonly(),

            Date::make('End')
                ->readonly(),

            BelongsTo::make(
                'User',
                'user',
                formatted: static fn (User $model) => $model->email,
                resource: UserResource::class,
            )
                ->badge(Color::PRIMARY)
                ->searchable()
                ->required(),

            Date::make('Created At')
                ->readonly(),

            Date::make('Updated At')
                ->readonly(),

            Date::make('Deleted At')
                ->readonly(),
        ];
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->only(Action::VIEW);
    }
}
