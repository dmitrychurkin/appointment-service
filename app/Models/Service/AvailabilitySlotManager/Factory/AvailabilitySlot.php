<?php

namespace App\Models\Service\AvailabilitySlotManager\Factory;

use App\Models\AppointmentAvailabilitySlot;
use Illuminate\Support\Carbon;

final class AvailabilitySlot
{
    public static function from(Carbon $start, Carbon $end): self
    {
        return new self($start, $end);
    }

    private function __construct(
        private readonly Carbon $start,
        private readonly Carbon $end,
    ) {}

    public function make(): AppointmentAvailabilitySlot
    {
        $appointmentAvailabilitySlot = new AppointmentAvailabilitySlot;

        $appointmentAvailabilitySlot->start = $this->start;
        $appointmentAvailabilitySlot->end = $this->end;

        return $appointmentAvailabilitySlot;
    }
}
