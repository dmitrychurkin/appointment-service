<?php

namespace Core\Features\Appointment\UseCase\Contracts\Data;

use Illuminate\Support\Carbon;

interface SlotMethods
{
    public function isBetween(Carbon $start, Carbon $end): bool;

    public function newSlotData(Carbon $start, Carbon $end): self;
}
