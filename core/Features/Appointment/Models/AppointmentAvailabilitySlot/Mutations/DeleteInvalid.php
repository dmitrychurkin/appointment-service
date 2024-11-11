<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Mutations;

trait DeleteInvalid
{
    /**
     * Delete the slot if it is invalid.
     */
    public function deleteInvalid(): bool
    {
        if ($this->isInvalid) {
            return $this->delete();
        }

        return false;
    }
}
