<?php

namespace Core\Features\Appointment\Contracts\Repositories;

use Core\Features\Appointment\Contracts\AppointmentSlot;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;

interface AppointmentAvailabilitySlot
{
    public function getAvailabilitySlot(AppointmentSlot $appointmentSlot): ?AppointmentAvailabilitySlotModel;
}
