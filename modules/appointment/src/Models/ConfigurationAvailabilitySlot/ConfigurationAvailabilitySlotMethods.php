<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot;

use DateTimeInterface;

trait ConfigurationAvailabilitySlotMethods
{
    public function isSameWeekDay(DateTimeInterface $date): bool
    {
        return $this->day_of_week === $date->dayOfWeek;
    }

    public function isSameDay(null|string|DateTimeInterface $date): bool
    {
        return $this->date->isSameDay($date);
    }
}
