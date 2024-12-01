<?php

namespace Core\Features\Appointment\Repositories;

use Core\Features\Appointment\Contracts\AppointmentSlot;
use Core\Features\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;

final class AppointmentAvailabilitySlotRepository implements AppointmentAvailabilitySlot
{
    public function getAvailabilitySlot(AppointmentSlot $appointmentSlot): ?AppointmentAvailabilitySlotModel
    {
        return AppointmentAvailabilitySlotModel::whereHasAvailabilitySlot($appointmentSlot)
            ->first();
    }
}
