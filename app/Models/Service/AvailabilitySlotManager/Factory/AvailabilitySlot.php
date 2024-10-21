<?php

namespace App\Models\Service\AvailabilitySlotManager\Factory;

use App\Models\AppointmentAvailabilitySlot;
use App\Models\Contract\Slot;
use App\Models\Factory\DataFactory;

final class AvailabilitySlot extends DataFactory
{
    public static function fromSlot(Slot $slot): self
    {
        return new self($slot);
    }

    private function __construct(
        private readonly Slot $slot,
    ) {}

    public function make(): AppointmentAvailabilitySlot
    {
        $appointmentAvailabilitySlot = new AppointmentAvailabilitySlot;

        $appointmentAvailabilitySlot->start = $this->slot->getStart();
        $appointmentAvailabilitySlot->end = $this->slot->getEnd();

        return $appointmentAvailabilitySlot;
    }
}
