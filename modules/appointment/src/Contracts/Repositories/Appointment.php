<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Repositories;

use AppointmentService\Appointment\Models\Appointment\Appointment as AppointmentModel;
use AppointmentService\Common\Contracts\TransformableData;
use DateTimeInterface;

interface Appointment
{
    public function createAppointment(TransformableData $appointmentSlot): AppointmentModel;

    public function getUserCountForDate(string|DateTimeInterface $date): int;
}
