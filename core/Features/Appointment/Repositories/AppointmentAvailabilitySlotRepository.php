<?php

namespace Core\Features\Appointment\Repositories;

use Core\Features\Appointment\Domain\Contracts\AppointmentAvailabilitySlotRepository as AppointmentAvailabilitySlotRepositoryContract;
use Core\Features\Appointment\Domain\Contracts\AppointmentSlot;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;

final class AppointmentAvailabilitySlotRepository implements AppointmentAvailabilitySlotRepositoryContract
{
    public function getAvailabilitySlot(AppointmentSlot $appointmentSlot): ?AppointmentAvailabilitySlot
    {
        return AppointmentAvailabilitySlot::whereHasAvailabilitySlot($appointmentSlot)
            ->first();
    }
}
