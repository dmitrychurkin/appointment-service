<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Repositories;

use AppointmentService\Common\Contracts\TransformableData;

interface Appointment
{
    public function createAppointment(TransformableData $appointmentSlot): void;
}
