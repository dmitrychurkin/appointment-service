<?php

namespace Core\Features\Appointment\Models\ConfigurationAvailabilitySlot\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

final class ConfigurationAvailabilitySlotOrderScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderByAsc('start_time');
    }
}
