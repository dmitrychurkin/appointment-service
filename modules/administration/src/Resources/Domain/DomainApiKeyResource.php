<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Resources\Domain;

use AppointmentService\Common\Facades\Str;
use AppointmentService\Domain\Models\DomainApiKey\DomainApiKey;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\Support\Enums\Color;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

#[Icon('key')]
final class DomainApiKeyResource extends ModelResource
{
    protected string $model = DomainApiKey::class;

    protected string $column = 'id';

    protected array $with = ['accountDomain'];

    public function getTitle(): string
    {
        return Str::singular(__('moonshine::ui.resource.module.domain.domain_api_key_title'));
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

            ID::make('Public Api Key', 'key')
                ->required()
                ->sortable()
                ->readonly(),

            BelongsTo::make(
                'Account Domain',
                'accountDomain',
                resource: AccountDomainResource::class,
            )
                ->badge(Color::PURPLE)
                ->searchable()
                ->required(),

            Text::make('Name'),

            Date::make('Created At')
                ->readonly(),

            Date::make('Updated At')
                ->readonly(),
        ];
    }
}
