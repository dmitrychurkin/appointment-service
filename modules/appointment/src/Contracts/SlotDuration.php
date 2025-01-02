<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

interface SlotDuration
{
    public function getDuration(): int;
}
