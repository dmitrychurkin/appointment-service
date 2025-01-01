<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Services;

use AppointmentService\Appointment\Contracts\Availability as AvailabilityData;
use Illuminate\Support\Collection;

interface Availability
{
    public function getAvailabilitySlots(AvailabilityData $availability): Collection;
}
