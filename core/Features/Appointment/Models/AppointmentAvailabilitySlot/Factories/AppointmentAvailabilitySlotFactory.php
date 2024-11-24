<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories;

use Core\Features\Appointment\Domain\Contracts\Slot;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Core\Features\Common\Factories\DataFactory;

final class AppointmentAvailabilitySlotFactory extends DataFactory
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
