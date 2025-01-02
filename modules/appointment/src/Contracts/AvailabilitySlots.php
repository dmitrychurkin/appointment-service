<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use Illuminate\Support\Carbon;

interface AvailabilitySlots extends SlotConfiguration, SlotDuration
{
    public function getDate(): Carbon;
}
