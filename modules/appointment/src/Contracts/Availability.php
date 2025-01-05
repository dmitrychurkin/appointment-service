<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use Illuminate\Support\Carbon;

interface Availability extends Slot, SlotConfiguration, SlotDuration
{
    public function getDate(): Carbon;
}
