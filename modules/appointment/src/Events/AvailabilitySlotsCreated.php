<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Events;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Common\Concerns\Dispatchable;

final class AvailabilitySlotsCreated
{
    use Dispatchable;

    public function __construct(
        public readonly AppointmentSlot $appointmentSlot
    ) {}
}
