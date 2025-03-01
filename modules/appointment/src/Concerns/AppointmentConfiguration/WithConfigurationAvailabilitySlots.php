<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Concerns\AppointmentConfiguration;

use AppointmentService\Common\Exceptions\ValidationException;
use DateTimeInterface;
use Illuminate\Support\Collection;

trait WithConfigurationAvailabilitySlots
{
    use WithConfigurationRecurrence;

    private Collection $configurationAvailabilitySlots;

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
        try {
            return $this->getConfigurationAvailabilitySlots(
                $this->withConfigurationRecurrence($date)
            )
                ->findByDate($date);
        } catch (ValidationException) {
            return collect();
        }
    }
}
