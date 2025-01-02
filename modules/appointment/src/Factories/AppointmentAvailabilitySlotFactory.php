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

        $start = $this->slot->getStart();
        $end = $this->slot->getEnd();

        $appointmentAvailabilitySlot->start = $start;
        $appointmentAvailabilitySlot->end = $end;
        $appointmentAvailabilitySlot->duration = $start->diffInMinutes($end);
        $appointmentAvailabilitySlot->date = $start->toDateString();

        return $appointmentAvailabilitySlot;
    }
}
