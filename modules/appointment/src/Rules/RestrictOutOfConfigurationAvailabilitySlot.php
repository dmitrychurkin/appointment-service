<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Rules;

use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Contracts\ValidationRule;
use AppointmentService\Common\Exceptions\ValidationException;
use Closure;

final class RestrictOutOfConfigurationAvailabilitySlot implements ValidationRule
{
    public static function test(
        AppointmentConfiguration $appointmentConfiguration,
        Slot $slot
    ): void {
        $start = $slot->getStart();
        $end = $slot->getEnd();

        if (
            ! $appointmentConfiguration->getConfigurationAvailabilitySlots($start)
                ->findByDate($start)
                ->some(function (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) use ($start, $end) {
                    $startTime = $configurationAvailabilitySlot->start_time->setDateFrom($start);
                    $endTime = $configurationAvailabilitySlot->end_time->setDateFrom($start);

                    return
                        $start->isBetween($startTime, $endTime) &&
                        $end->isBetween($startTime, $endTime);
                })
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
            self::test($value, SlotData::from([
                'start' => now()->parse(request('start')),
                'end' => now()->parse(request('end')),
            ]));
        } catch (ValidationException $exception) {
            $fail($exception->getMessage())->translate();
        }
    }
}
