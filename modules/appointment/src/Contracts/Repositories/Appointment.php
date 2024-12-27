<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Repositories;

use AppointmentService\Appointment\Contracts\AppointmentSlot;

interface Appointment
{
    public function createAppointment(AppointmentSlot $appointmentSlot): void;
}
