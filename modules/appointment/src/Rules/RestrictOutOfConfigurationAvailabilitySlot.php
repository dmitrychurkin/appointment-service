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
        if (! $value->configurationAvailabilitySlots->some(function (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) {
            if (! $configurationAvailabilitySlot->date || $configurationAvailabilitySlot->date->isSameDay(request('start'))) {
                return
                    ($configurationAvailabilitySlot->start_time->format('H:i:s') <= now()->parse(request('start'))->format('H:i:s')) &&
                    ($configurationAvailabilitySlot->end_time->format('H:i:s') >= now()->parse(request('end'))->format('H:i:s'));
            }
        })) {
            $fail('appointment::validation.appointment_slot_not_available')->translate();
        }
    }
}
