<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Concerns;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use DateTimeInterface;
use Illuminate\Support\Collection;

trait WithAppointmentConfiguration
{
    private static Collection $configurationAvailabilitySlots;

    public function getAppointmentConfiguration(): AppointmentConfiguration
    {
        return $this->appointmentConfiguration;
    }

    public function getConfigurationAvailabilitySlots(null|string|array|DateTimeInterface $date): Collection
    {
        if (! isset(self::$configurationAvailabilitySlots)) {
            self::$configurationAvailabilitySlots = $this->appointmentConfiguration
                ->getConfigurationAvailabilitySlots($date);
        }

        return self::$configurationAvailabilitySlots;
    }

    public function selectConfigurationAvailabilitySlots(null|string|DateTimeInterface $date): Collection
    {
        return $this->getConfigurationAvailabilitySlots($date)
            ->findByDate($date);
    }
}
