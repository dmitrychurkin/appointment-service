<?php

namespace App\Models\Appointment\Builder;

use App\Models\Appointment\Data\AppointmentSlot;
use Illuminate\Database\Eloquent\Builder;

final class AvailabilitySlotBuilder extends Builder
{
    public function whereHasAvailabilitySlot(AppointmentSlot $appointmentSlot): self
    {
        return $this->whereBetween('from', [$appointmentSlot->start, $appointmentSlot->end])
            ->whereBetween('to', [$appointmentSlot->start, $appointmentSlot->end]);
    }
}
