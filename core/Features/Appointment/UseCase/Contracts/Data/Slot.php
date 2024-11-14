<?php

namespace Core\Features\Appointment\UseCase\Contracts\Data;

use Illuminate\Support\Carbon;

interface Slot
{
    public function getStart(): Carbon;

    public function getEnd(): Carbon;
}
