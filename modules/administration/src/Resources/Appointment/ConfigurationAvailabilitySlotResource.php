<?php

declare(strict_types=1);

namespace AppointmentService\Administration\Resources\Appointment;

use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Facades\Str;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Attributes\Icon;
use MoonShine\UI\Fields\ID;

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

    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
        ];
    }
}
