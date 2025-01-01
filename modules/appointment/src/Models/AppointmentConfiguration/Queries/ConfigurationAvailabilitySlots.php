<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration\Queries;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ConfigurationAvailabilitySlots
{
    public function whereConfigurationAvailabilitySlots(null|string|DateTimeInterface $date): HasMany
    {
        return $this->configurationAvailabilitySlots()
            ->whereNull('date')
            ->orWhereDate('date', now()->parse($date));
    }
}
