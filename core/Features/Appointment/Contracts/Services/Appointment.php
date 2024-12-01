<?php

namespace Core\Features\Appointment\Contracts\Services;

use Core\Features\Appointment\Contracts\AppointmentSlot;

interface Appointment
{
    public function create(AppointmentSlot $appointmentSlot): void;
}
