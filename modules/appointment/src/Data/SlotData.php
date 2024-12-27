<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Concerns\WithSlot;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Contracts\SlotMethods;
use AppointmentService\Common\Data\Data;
use Illuminate\Support\Carbon;

class SlotData extends Data implements Slot, SlotMethods
{
    use WithSlot;

    public function __construct(
        public Carbon $start,
        public Carbon $end,
    ) {}

    public function newSlotData(Carbon $start, Carbon $end): self
    {
        return new self($start, $end);
    }

    public function isBetween(Carbon $start, Carbon $end): bool
    {
        return
            $this->start->isBetween($start, $end) &&
            $this->end->isBetween($start, $end);
    }

    public function setStartTimeFrom(Carbon $date): self
    {
        $this->start->setTimeFrom($date);

        return $this;
    }

    public function setEndTimeFrom(Carbon $date): self
    {
        $this->end->setTimeFrom($date);

        return $this;
    }
}
