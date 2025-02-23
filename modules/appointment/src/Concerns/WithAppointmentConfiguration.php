<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Concerns;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use DateTimeInterface;
use Illuminate\Support\Collection;

trait WithAppointmentConfiguration
{
    private Collection $configurationAvailabilitySlots;

    public function getAppointmentConfiguration(): AppointmentConfiguration
    {
        return $this->appointmentConfiguration;
    }

    public function getConfigurationAvailabilitySlots(null|string|array|DateTimeInterface $date): Collection
    {
        if (! isset($this->configurationAvailabilitySlots)) {
            $this->configurationAvailabilitySlots = $this->appointmentConfiguration
                ->getConfigurationAvailabilitySlots($date);
        }

        return $this->configurationAvailabilitySlots;
    }

    public function selectConfigurationAvailabilitySlots(null|string|DateTimeInterface $date): Collection
    {
        return $this->getConfigurationAvailabilitySlots($date)
            ->findByDate($date);
    }
}
