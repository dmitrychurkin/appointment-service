<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\Collections;

use AppointmentService\Common\Collections\Collection as CommonCollection;
use DateTimeInterface;
use Illuminate\Support\Collection;

final class ConfigurationAvailabilitySlotCollection extends CommonCollection
{
    /**
     * Find the configuration availability slots by date.
     *
     * In future we will extend this method to support more complex date and recurring logic.
     */
    public function findByDate(null|string|DateTimeInterface $date): Collection
    {
        $recurringConfigurationAvailabilitySlots = collect();
        $fixedConfigurationAvailabilitySlots = collect();

        foreach ($this as $slot) {
            if (is_null($slot->date)) {
                $recurringConfigurationAvailabilitySlots->push($slot);

                continue;
            }

            if ($slot->date->isSameDay($date)) {
                $fixedConfigurationAvailabilitySlots->push($slot);
            }
        }

        return $fixedConfigurationAvailabilitySlots->isEmpty()
            ? $recurringConfigurationAvailabilitySlots
            : $fixedConfigurationAvailabilitySlots;
    }
}
