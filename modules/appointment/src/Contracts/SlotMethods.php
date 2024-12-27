<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use Illuminate\Support\Carbon;

interface SlotMethods
{
    public function isBetween(Carbon $start, Carbon $end): bool;

    public function newSlotData(Carbon $start, Carbon $end): self;

    public function setStartTimeFrom(Carbon $date): self;

    public function setEndTimeFrom(Carbon $date): self;
}
