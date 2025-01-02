<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Services;

use AppointmentService\Appointment\Contracts\Availability as AvailabilityData;
use AppointmentService\Appointment\Contracts\Services\Availability;
use AppointmentService\Appointment\Queries\AvailabilitySlotsQuery;
use Illuminate\Support\Collection;

final class AvailabilityService implements Availability
{
    public function __construct(
        private readonly AvailabilitySlotsQuery $availabilitySlotsQuery
    ) {}

    public function getAvailabilitySlots(AvailabilityData $availability): Collection
    {
        $execute = $this->availabilitySlotsQuery;

        return $execute($availability);
    }
}
