<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Rules;

use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;
use AppointmentService\Common\Contracts\ValidationRule;
use AppointmentService\Common\Exceptions\ValidationException;
use Closure;
use DateTimeInterface;
use Facades\AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;

final class AppointmentAvailabilitySlotPresence implements ValidationRule
{
    public static function test(
        ?AppointmentAvailabilitySlotModel $appointmentAvailabilitySlot,
        string|DateTimeInterface $startDate
    ): void {
        if (
            ! $appointmentAvailabilitySlot &&
            AppointmentAvailabilitySlot::exists($startDate)
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
