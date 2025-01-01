<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Rules;

use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Contracts\ValidationRule;
use Closure;

final class RestrictOutOfConfigurationAvailabilitySlot implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $start = now()->parse(request('start'));
        $end = now()->parse(request('end'));

        if (
            ! $value->getConfigurationAvailabilitySlots($start)
                ->some(function (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) use ($start, $end) {
                    $startTime = $configurationAvailabilitySlot->start_time->setDateFrom($start);
                    $endTime = $configurationAvailabilitySlot->end_time->setDateFrom($start);

                    return
                        $start->isBetween($startTime, $endTime) &&
                        $end->isBetween($startTime, $endTime);
                })
        ) {
            $fail('appointment::validation.appointment_slot_not_available')->translate();
        }
    }
}
