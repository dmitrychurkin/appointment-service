<?php

namespace App\Models\Contract;

use Illuminate\Support\Carbon;

interface Slot
{
    public function getStart(): Carbon;

    public function getEnd(): Carbon;
}
