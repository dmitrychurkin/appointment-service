<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Repositories;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;

interface AppointmentAvailabilitySlot
{
    public function getAvailabilitySlot(AppointmentSlot $appointmentSlot): ?AppointmentAvailabilitySlotModel;
}
