<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Resources\Appointment;

use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Common\Facades\Str;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

#[Icon('user-circle')]
final class AccountResource extends ModelResource
{
    protected string $model = Account::class;

    protected string $column = 'id';

    public function getTitle(): string
    {
        return Str::singular(__('moonshine::ui.resource.module.appointment.account_title'));
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

            Text::make('Name')
                ->required(),

            Text::make('Slug')
                ->required(),

            Date::make('Created At', 'created_at')
                ->readonly(),

            Date::make('Updated At', 'updated_at')
                ->readonly(),

            Date::make('Deleted At', 'deleted_at')
                ->readonly(),
        ];
    }
}
