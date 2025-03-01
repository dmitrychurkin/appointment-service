<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Rules;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Common\Contracts\ValidationRule;
use AppointmentService\Common\Exceptions\ValidationException;
use Closure;
use DateTimeInterface;

final class GeneralAvailability implements ValidationRule
{
    public static function test(
        AppointmentConfiguration $appointmentConfiguration,
        string|DateTimeInterface $startDate
    ): void {
        $start = now()->parse($startDate);
        $configurationRecurrence = $appointmentConfiguration->configurationRecurrence;

        if (
            $start->isBefore($configurationRecurrence->start) ||
            ($configurationRecurrence->end && $start->greaterThanOrEqualTo($configurationRecurrence->end)) ||
            (floor($configurationRecurrence->start->diffInWeeks($start, true)) % $configurationRecurrence->repeat_every_weeks)
        ) {
            throw new ValidationException(
                message: 'appointment::validation.appointment_slot_not_available'
            );
        }
    }

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            self::test($value, request('start'));
        } catch (ValidationException $exception) {
            $fail($exception->getMessage())->translate();
        }
    }
}
