<?php

namespace App\Models\Data;

use App\Models\Concern\WithSlot;
use App\Models\Contract\Slot as SlotContract;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

class Slot extends Data implements SlotContract
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
