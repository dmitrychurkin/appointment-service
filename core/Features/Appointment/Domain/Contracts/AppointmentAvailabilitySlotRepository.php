<?php

namespace Core\Features\Appointment\Domain\Contracts;

use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;

interface AppointmentAvailabilitySlotRepository
{
    public function getAvailabilitySlot(AppointmentSlot $appointmentSlot): ?AppointmentAvailabilitySlot;
}
