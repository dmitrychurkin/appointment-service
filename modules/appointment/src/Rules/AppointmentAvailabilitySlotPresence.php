<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Rules;

use AppointmentService\Common\Contracts\ValidationRule;
use Closure;
use Facades\AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;

final class AppointmentAvailabilitySlotPresence implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            ! $value &&
            AppointmentAvailabilitySlot::exists(request('start'))
        ) {
            $fail('appointment::validation.appointment_slot_not_available')->translate();
        }
    }
}
