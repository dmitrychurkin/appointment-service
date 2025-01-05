<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Services;

use AppointmentService\Appointment\Contracts\Availability as AvailabilityData;
use AppointmentService\Appointment\Contracts\Services\Availability;
use AppointmentService\Appointment\Queries\AvailabilityQuery;
use AppointmentService\Appointment\Queries\AvailabilitySlotsQuery;
use Illuminate\Support\Collection;

final class AvailabilityService implements Availability
{
    public function __construct(
        private readonly AvailabilitySlotsQuery $availabilitySlotsQuery,
        private readonly AvailabilityQuery $availabilityQuery
    ) {}

    public function getAvailabilitySlots(AvailabilityData $availability): Collection
    {
        $execute = $this->availabilitySlotsQuery;

        return $execute($availability);
    }

    public function getAvailability(AvailabilityData $availability): Collection
    {
        $execute = $this->availabilityQuery;

        return $execute($availability);
    }
}
