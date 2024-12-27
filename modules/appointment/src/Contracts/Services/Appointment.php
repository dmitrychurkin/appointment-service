<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Services;

use AppointmentService\Appointment\Contracts\AppointmentSlot;

interface Appointment
{
    public function create(AppointmentSlot $appointmentSlot): void;
}
