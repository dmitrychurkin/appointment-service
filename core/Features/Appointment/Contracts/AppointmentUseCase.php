<?php

namespace Core\Features\Appointment\Contracts;

use Core\Features\Appointment\Data\AppointmentSlotData;

interface AppointmentUseCase
{
    public function create(AppointmentSlotData $appointmentSlot): void;
}
