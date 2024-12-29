<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Repositories;

use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;
use DateTimeInterface;

interface AppointmentAvailabilitySlot
{
    public function exists(string|DateTimeInterface $date): bool;

    public function getAvailabilitySlot(Slot $appointmentSlot): ?AppointmentAvailabilitySlotModel;
}
