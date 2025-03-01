<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\Attributes;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait IsRecurring
{
    public function isRecurring(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => is_null($attributes['date']),
        );
    }
}
