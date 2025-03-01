<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\Collections;

use AppointmentService\Common\Collections\Collection as CommonCollection;
use DateTimeInterface;
use Illuminate\Support\Collection;

final class ConfigurationAvailabilitySlotCollection extends CommonCollection
{
    /*
        This method unfortunately didn't let us to achieve the desired performance result.
        With OPCache enabled, the performance has degraded by 10%. ~ +30ms
        ================================================================================
    private const RECURRING_WEEKLY = 'weekly';

    private Collection $configurationAvailabilitySlots;

    public function findByDate(null|string|DateTimeInterface $date): Collection
    {
        $this->configurationAvailabilitySlots ??= collect();

        $getKey = fn(null|string|DateTimeInterface $date) => (
            is_null($date)
                ? self::RECURRING_WEEKLY
                : now()->parse($date)->toDateString()
        );

        $retrieve = fn(null|string|DateTimeInterface $date) => (
            $this->configurationAvailabilitySlots->get(
                $getKey($date),
                fn () => $this->configurationAvailabilitySlots->get($getKey(null), collect())
            )
        );


        if ($this->configurationAvailabilitySlots->isNotEmpty()) {
            return $retrieve($date);
        }

        foreach ($this as $slot) {
            $key = $getKey($slot->date);

            $configurationAvailabilitySlots = collect($this->configurationAvailabilitySlots->pull($key, collect()));

            $this->configurationAvailabilitySlots->put($key, $configurationAvailabilitySlots->push($slot));
        }

        return $retrieve($date);
    }*/

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
                if ($slot->day_of_week === $date->dayOfWeek) {
                    $recurringConfigurationAvailabilitySlots->push($slot);
                }

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
