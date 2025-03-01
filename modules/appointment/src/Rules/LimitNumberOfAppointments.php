<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Rules;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Common\Contracts\ValidationRule;
use AppointmentService\Common\Exceptions\ValidationException;
use Closure;
use DateTimeInterface;
use Facades\AppointmentService\Appointment\Repositories\AppointmentRepository;

final class LimitNumberOfAppointments implements ValidationRule
{
    public static function test(
        AppointmentConfiguration $appointmentConfiguration,
        string|DateTimeInterface $startDate
    ): void {
        $appointmentPerDay = $appointmentConfiguration->appointments_per_day;

        if (
            ! is_null($appointmentPerDay) &&
            (AppointmentRepository::getUserCountForDate($startDate) > $appointmentPerDay)
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
