<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration\Queries;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ConfigurationAvailabilitySlots
{
    public function whereConfigurationAvailabilitySlots(null|string|array|DateTimeInterface $date): HasMany
    {
        return $this->configurationAvailabilitySlots()
            ->whereNull('date')
            ->when(
                is_array($date),
                fn (Builder $query) => $query->orWhereBetween('date', $date),
                fn (Builder $query) => $query->when(
                    $date,
                    fn (Builder $query, string|DateTimeInterface $date) => $query->orWhereDate('date', now()->parse($date))
                )
            );
    }
}
