<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait isInvalid
{
    public function isInvalid(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['duration'] <= 0,
        );
    }
}
