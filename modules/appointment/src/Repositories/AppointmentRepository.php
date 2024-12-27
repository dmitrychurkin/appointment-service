<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Contracts\Repositories\Appointment;
use AppointmentService\Appointment\Models\Appointment\Appointment as AppointmentModel;

final class AppointmentRepository implements Appointment
{
    public function createAppointment(AppointmentSlot $appointmentSlot): void
    {
        AppointmentModel::create($appointmentSlot->toArray());
    }
}
