<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Queries;

use Core\Features\Appointment\Data\AppointmentSlotData;

trait HasAvailabilitySlot
{
    /**
     * Check if the availability slot exists.
     *
     * @param  int  $id
     * @return bool
     */
    public function whereHasAvailabilitySlot(AppointmentSlotData $appointmentSlot): self
    {
        $start = $appointmentSlot->getStart();
        $end = $appointmentSlot->getEnd();

        return $this->whereBetween('from', [$start, $end])
            ->whereBetween('to', [$start, $end]);
    }
}
