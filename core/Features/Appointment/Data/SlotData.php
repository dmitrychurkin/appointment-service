<?php

namespace Core\Features\Appointment\Data;

use Core\Features\Appointment\Concerns\WithSlot;
use Core\Features\Appointment\Contracts\Slot as SlotContract;
use Core\Features\Common\Data\Data;
use Illuminate\Support\Carbon;

class SlotData extends Data implements SlotContract
{
    use WithSlot;

    public function __construct(
        private readonly Carbon $start,
        private readonly Carbon $end,
    ) {}

    public function isBetween(Carbon $start, Carbon $end): bool
    {
        return
            $this->start->isBetween($start, $end) &&
            $this->end->isBetween($start, $end);
    }
}
