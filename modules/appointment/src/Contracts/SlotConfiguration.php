<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use Illuminate\Support\Collection;

interface SlotConfiguration
{
    public function getConfigurationAvailabilitySlots(): Collection;
}
