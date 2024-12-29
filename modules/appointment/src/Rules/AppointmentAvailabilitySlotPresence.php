<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Rules;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Common\Contracts\ValidationRule;
use Closure;

final class AppointmentAvailabilitySlotPresence implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            ! $value &&
            resolve(AppointmentAvailabilitySlotRepository::class)->exists(request()->input('start'))
        ) {
            $fail('The appointment availability slot does not exist.');
        }
    }
}
