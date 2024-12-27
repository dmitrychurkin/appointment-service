<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use Illuminate\Support\Carbon;

interface Slot
{
    public function getStart(): Carbon;

    public function getEnd(): Carbon;
}
