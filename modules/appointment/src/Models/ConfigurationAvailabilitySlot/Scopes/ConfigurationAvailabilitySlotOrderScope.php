<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\Scopes;

use AppointmentService\Common\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class ConfigurationAvailabilitySlotOrderScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderBy('start_time');
    }
}
