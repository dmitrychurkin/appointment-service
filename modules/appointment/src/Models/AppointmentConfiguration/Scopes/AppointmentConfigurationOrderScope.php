<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration\Scopes;

use AppointmentService\Common\Contracts\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

final class AppointmentConfigurationOrderScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderByDesc('version');
    }
}
