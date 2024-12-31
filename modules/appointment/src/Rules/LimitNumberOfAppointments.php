<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Rules;

use AppointmentService\Appointment\Repositories\AppointmentRepository;
use AppointmentService\Common\Contracts\ValidationRule;
use Closure;

final class LimitNumberOfAppointments implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (
            ! is_null($value->appointments_per_day) &&
            (resolve(AppointmentRepository::class)->getUserCountForDate(request('start')) > $value->appointments_per_day)
        ) {
            $fail('appointment::validation.appointment_slot_not_available')->translate();
        }
    }
}
