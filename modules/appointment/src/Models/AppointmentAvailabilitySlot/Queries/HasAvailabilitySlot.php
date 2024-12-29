<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Queries;

use AppointmentService\Appointment\Contracts\Slot;

trait HasAvailabilitySlot
{
    /**
     * Check if the availability slot exists.
     *
     * @param  int  $id
     * @return bool
     */
    public function whereHasAvailabilitySlot(Slot $appointmentSlot): self
    {
        return $this->where('start', '<=', $appointmentSlot->getStart())
            ->where('end', '>=', $appointmentSlot->getEnd());
    }
}
