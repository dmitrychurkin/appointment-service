<?php

namespace Core\Features\Appointment\Data;

use Core\Features\Appointment\Concerns\WithSlot;
use Core\Features\Appointment\Contracts\Slot;
use Core\Features\Appointment\Contracts\SlotMethods;
use Core\Features\Common\Data\Data;
use Illuminate\Support\Carbon;

class SlotData extends Data implements Slot, SlotMethods
{
    use WithSlot;

    protected function __construct(
        private readonly Carbon $start,
        private readonly Carbon $end,
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
