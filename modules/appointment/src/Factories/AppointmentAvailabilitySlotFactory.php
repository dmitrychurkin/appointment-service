<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Factories;

use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use AppointmentService\Common\Factories\DataFactory;

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
