<?php

namespace App\Models\Concern;

use Illuminate\Support\Carbon;

trait Slot
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
