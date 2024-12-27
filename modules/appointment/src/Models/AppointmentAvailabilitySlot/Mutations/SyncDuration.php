<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Mutations;

trait SyncDuration
{
    /**
     * Sync the duration of the slot.
     */
    public function syncDuration(): self
    {
        $this->date = $this->getStart()->toDateString();
        $this->duration = $this->getStart()->diffInMinutes($this->getEnd());

        return $this;
    }
}
