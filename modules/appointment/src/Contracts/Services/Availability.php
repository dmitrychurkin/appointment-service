<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Services;

use AppointmentService\Appointment\Contracts\AvailabilitySlots as AvailabilitySlotsData;
use Illuminate\Support\Collection;

interface Availability
{
    public function getAvailabilitySlots(AvailabilitySlotsData $availabilitySlots): Collection;
}
