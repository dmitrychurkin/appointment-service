<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Resources\Appointment;

use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\User\User;
use AppointmentService\Common\Facades\Str;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\Collapse;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Fields\Text;

#[Icon('user')]
final class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $column = 'id';

    protected array $with = ['account'];

    public function getTitle(): string
    {
        return Str::singular(__('moonshine::ui.resource.module.appointment.user_title'));
    }

    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }

    protected function formFields(): iterable
    {
        return [
            Box::make([
                Tabs::make([
                    Tab::make(__('moonshine::ui.resource.main_information'), [
                        ...$this->indexFields(),
                    ])->icon('user-circle'),

                    Tab::make(__('moonshine::ui.resource.password'), [
                        Collapse::make(__('moonshine::ui.resource.change_password'), [
                            Password::make(__('moonshine::ui.resource.password'), 'password')
                                ->customAttributes(['autocomplete' => 'new-password'])
                                ->eye(),

                            PasswordRepeat::make(__('moonshine::ui.resource.repeat_password'), 'password_repeat')
                                ->customAttributes(['autocomplete' => 'confirm-password'])
                                ->eye(),
                        ])->icon('lock-closed'),
                    ])->icon('lock-closed'),
                ]),
            ]),
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->required(),

            Email::make('Email')
                ->required(),

            Text::make('Timezone')
                ->required(),

            BelongsTo::make(
                'Account',
                'account',
                formatted: static fn (Account $model) => $model->slug,
                resource: AccountResource::class,
            )
                ->badge(Color::PURPLE)
                ->searchable()
                ->required(),

            Date::make('Created At')
                ->readonly(),

            Date::make('Updated At')
                ->readonly(),
        ];
    }
}
