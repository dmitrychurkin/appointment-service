<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration;

use DateTimeInterface;
use Illuminate\Support\Collection;

trait AppointmentConfigurationMethods
{
    public function getConfigurationAvailabilitySlots(null|string|array|DateTimeInterface $date): Collection
    {
        return $this->whereConfigurationAvailabilitySlots($date)->get();
    }
}
