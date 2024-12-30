<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot;

final class AppointmentAvailabilitySlotObserver
{
    /**
     * Handle the AppointmentAvailabilitySlot "saving" event.
     */
    public function saving(AppointmentAvailabilitySlot $appointmentAvailabilitySlot): void
    {
        $appointmentAvailabilitySlot->syncDuration();
    }

    /**
     * Handle the AppointmentAvailabilitySlot "created / updated" event.
     */
    public function saved(AppointmentAvailabilitySlot $appointmentAvailabilitySlot): void
    {
        $appointmentAvailabilitySlot->deleteInvalid();
    }
}
