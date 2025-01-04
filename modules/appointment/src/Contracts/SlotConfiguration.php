<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use DateTimeInterface;
use Illuminate\Support\Collection;

interface SlotConfiguration
{
    public function getAppointmentConfiguration(): AppointmentConfiguration;

    public function getConfigurationAvailabilitySlots(null|string|array|DateTimeInterface $date): Collection;

    public function selectConfigurationAvailabilitySlots(null|string|DateTimeInterface $date): Collection;
}
