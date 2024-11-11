<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot;

final class AppointmentAvailabilitySlotObserver
{
    /**
     * Handle the AppointmentAvailabilitySlot "created" event.
     */
    public function created(AppointmentAvailabilitySlot $appointmentAvailabilitySlot): void
    {
        $appointmentAvailabilitySlot->deleteInvalid();
    }

    /**
     * Handle the AppointmentAvailabilitySlot "updated" event.
     */
    public function updated(AppointmentAvailabilitySlot $appointmentAvailabilitySlot): void
    {
        $appointmentAvailabilitySlot->deleteInvalid();
    }
}
