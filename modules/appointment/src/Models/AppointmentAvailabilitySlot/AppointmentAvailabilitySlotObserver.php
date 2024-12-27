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
