<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use Illuminate\Support\Carbon;

interface SlotMethods
{
    public function isBetween(Carbon $start, Carbon $end): bool;
}
