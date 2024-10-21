<?php

namespace App\Models\Concern;

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
