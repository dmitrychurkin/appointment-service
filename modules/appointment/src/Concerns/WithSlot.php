<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Concerns;

use Illuminate\Support\Carbon;

trait WithSlot
{
    public function getStart(): Carbon
    {
        return $this->start->copy();
    }

    public function getEnd(): Carbon
    {
        return $this->end->copy();
    }
}
