<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use DateTimeInterface;

interface Availability
{
    public function getDate(): DateTimeInterface;

    public function getDuration(): int;
}
