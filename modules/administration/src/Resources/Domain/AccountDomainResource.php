<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Resources\Domain;

use AppointmentService\Administration\Resources\Appointment\AccountResource;
use AppointmentService\Common\Facades\Str;
use AppointmentService\Domain\Models\AccountDomain\AccountDomain;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasOne;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\URL;

#[Icon('building-office')]
final class AccountDomainResource extends ModelResource
{
    protected string $model = AccountDomain::class;

    protected string $column = 'id';

    protected array $with = ['domainApiKey'];

    public function getTitle(): string
    {
        return Str::singular(__('moonshine::ui.resource.module.domain.account_domain_title'));
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

            BelongsTo::make(
                'Account',
                'account',
                resource: AccountResource::class,
            )
                ->badge(Color::PURPLE)
                ->searchable()
                ->required(),

            HasOne::make(
                'Domain Api Key',
                'domainApiKey',
                resource: DomainApiKeyResource::class,
            )
                ->badge(Color::GREEN),

            URL::make('Domain')
                ->required(),

            Date::make('Created At')
                ->readonly(),

            Date::make('Updated At')
                ->readonly(),
        ];
    }
}
