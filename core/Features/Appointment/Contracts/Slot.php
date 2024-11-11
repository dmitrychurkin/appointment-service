<?php

namespace Core\Features\Appointment\Contracts;

use Illuminate\Support\Carbon;

interface Slot
{
    public function getStart(): Carbon;

    public function getEnd(): Carbon;
}
