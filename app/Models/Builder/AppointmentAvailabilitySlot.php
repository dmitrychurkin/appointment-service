<?php

namespace App\Models\Builder;

use App\Models\Data\AppointmentSlot;
use Illuminate\Database\Eloquent\Builder;

final class AppointmentAvailabilitySlot extends Builder
{
    public function whereHasAvailabilitySlot(AppointmentSlot $appointmentSlot): self
    {
        $start = $appointmentSlot->getStart();
        $end = $appointmentSlot->getEnd();

        return $this->whereBetween('from', [$start, $end])
            ->whereBetween('to', [$start, $end]);
    }
}
