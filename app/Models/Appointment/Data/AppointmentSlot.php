<?php

namespace App\Models\Appointment\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

abstract class AppointmentSlot extends Data
{
    public function __construct(
        public readonly Carbon $start,
        public readonly Carbon $end
    ) {}
}
