<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use Illuminate\Support\Carbon;

interface Availability extends SlotMethods
{
    public function getDate(): Carbon;

    public function getDuration(): int;
}
