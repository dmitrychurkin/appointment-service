<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

trait Slots
{
    public function start(): Attribute
    {
        return Attribute::make(
            set: fn (Carbon $value) => [
                'date' => $value,
                'from' => $value,
                'duration' => $value->diffInMinutes($this->end),
            ],
        );
    }

    public function end(): Attribute
    {
        return Attribute::make(
            set: fn (Carbon $value) => [
                'to' => $value,
                'duration' => $this->start->diffInMinutes($value),
            ],
        );
    }
}
