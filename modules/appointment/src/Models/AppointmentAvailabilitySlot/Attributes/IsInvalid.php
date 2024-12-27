<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait IsInvalid
{
    public function isInvalid(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['duration'] <= 0,
        );
    }
}
