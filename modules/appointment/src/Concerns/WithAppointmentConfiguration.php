<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Concerns;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use DateTimeInterface;
use Illuminate\Support\Collection;

trait WithAppointmentConfiguration
{
    public function getAppointmentConfiguration(): AppointmentConfiguration
    {
        return $this->appointmentConfiguration;
    }

    public function getConfigurationAvailabilitySlots(null|string|DateTimeInterface $date): Collection
    {
        return once(
            fn () => $this->appointmentConfiguration
                ->getConfigurationAvailabilitySlots($date)
        );
    }
}
