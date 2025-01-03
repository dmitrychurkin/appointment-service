<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;
use DateTimeInterface;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotRepository implements AppointmentAvailabilitySlot
{
    public function exists(string|DateTimeInterface $date): bool
    {
        return AppointmentAvailabilitySlotModel::whereDate('date', now()->parse($date))
            ->exists();
    }

    public function getAvailabilitySlot(Slot $appointmentSlot): ?AppointmentAvailabilitySlotModel
    {
        return AppointmentAvailabilitySlotModel::whereAvailabilitySlot($appointmentSlot)
            ->first();
    }

    public function getAvailabilitySlots(string|array|DateTimeInterface $date, ?array $orderBy = null): Collection
    {
        return AppointmentAvailabilitySlotModel::whereAvailabilitySlots($date, $orderBy)
            ->get();
    }
}
