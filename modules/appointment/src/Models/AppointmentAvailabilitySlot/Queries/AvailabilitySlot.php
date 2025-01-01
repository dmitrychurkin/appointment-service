<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Queries;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Contracts\Slot;

trait AvailabilitySlot
{
    public function whereAvailabilitySlot(Slot $appointmentSlot): self
    {
        return $this->where('start', '<=', $appointmentSlot->getStart())
            ->where('end', '>=', $appointmentSlot->getEnd());
    }

    public function whereAvailabilitySlots(Availability $availability): self
    {
        return $this->whereDate('date', $availability->getDate())
            ->where('duration', '>=', $availability->getDuration())
            ->orderBy('start');
    }
}
