<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Concerns\AppointmentConfiguration;

use AppointmentService\Appointment\Models\ConfigurationRecurrence\ConfigurationRecurrence;
use AppointmentService\Appointment\Rules\GeneralAvailability;
use DateTimeInterface;

trait WithConfigurationRecurrence
{
    public function getConfigurationRecurrence(): ConfigurationRecurrence
    {
        return $this->getAppointmentConfiguration()->configurationRecurrence;
    }

    public function withConfigurationRecurrence(null|string|DateTimeInterface $date): null|string|DateTimeInterface
    {
        ! $date ?: GeneralAvailability::test($this->getAppointmentConfiguration(), $date);

        return $date;
    }
}
