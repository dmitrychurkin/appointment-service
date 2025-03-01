<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Concerns\AppointmentConfiguration;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;

trait WithAppointmentConfiguration
{
    use WithConfigurationAvailabilitySlots, WithConfigurationRecurrence;

    public function getAppointmentConfiguration(): AppointmentConfiguration
    {
        return $this->appointmentConfiguration;
    }
}
