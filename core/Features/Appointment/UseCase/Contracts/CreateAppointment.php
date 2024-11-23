<?php

namespace Core\Features\Appointment\UseCase\Contracts;

use Core\Features\Appointment\Domain\Contracts\AppointmentSlot;

interface CreateAppointment
{
    public function create(AppointmentSlot $appointmentSlot): void;
}
