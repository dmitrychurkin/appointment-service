<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;

final class AppointmentAvailabilitySlotRepository implements AppointmentAvailabilitySlot
{
    public function getAvailabilitySlot(AppointmentSlot $appointmentSlot): ?AppointmentAvailabilitySlotModel
    {
        return AppointmentAvailabilitySlotModel::whereHasAvailabilitySlot($appointmentSlot)
            ->first();
    }
}
