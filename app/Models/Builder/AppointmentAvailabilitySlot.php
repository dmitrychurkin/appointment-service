<?php

namespace App\Models\Builder;

use App\Models\Data\AppointmentSlot;
use Illuminate\Database\Eloquent\Builder;

final class AppointmentAvailabilitySlot extends Builder
{
    public function whereHasAvailabilitySlot(AppointmentSlot $appointmentSlot): self
    {
        return $this->whereBetween('from', [$appointmentSlot->start, $appointmentSlot->end])
            ->whereBetween('to', [$appointmentSlot->start, $appointmentSlot->end]);
    }
}
