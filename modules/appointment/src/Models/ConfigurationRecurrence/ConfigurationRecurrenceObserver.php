<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationRecurrence;

final class ConfigurationRecurrenceObserver
{
    /**
     * Handle the ConfigurationRecurrence "creating" event.
     */
    public function creating(ConfigurationRecurrence $configurationRecurrence): void
    {
        $configurationRecurrence->start ??= now();
        $configurationRecurrence->repeat_every_weeks = $configurationRecurrence->repeat_every_weeks ?: 1;
    }
}
