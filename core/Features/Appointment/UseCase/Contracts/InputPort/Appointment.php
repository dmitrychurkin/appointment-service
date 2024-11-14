<?php

namespace Core\Features\Appointment\UseCase\Contracts\InputPort;

use Core\Features\Appointment\UseCase\Contracts\Data\AppointmentSlot;

interface Appointment
{
    public function create(AppointmentSlot $appointmentSlot): void;
}
