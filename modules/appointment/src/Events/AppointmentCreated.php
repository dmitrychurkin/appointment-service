<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Events;

use AppointmentService\Appointment\Models\Appointment\Appointment;
use AppointmentService\Common\Concerns\Dispatchable;

final class AppointmentCreated
{
    use Dispatchable;

    public function __construct(
        public readonly Appointment $appointment
    ) {}
}
