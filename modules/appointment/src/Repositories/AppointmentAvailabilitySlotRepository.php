<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;
use AppointmentService\Common\Concerns\Repository;
use DateTimeInterface;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotRepository implements AppointmentAvailabilitySlot
{
    use Repository;

    public function __construct(
        private readonly AppointmentAvailabilitySlotModel $model
    ) {}

    public function exists(string|DateTimeInterface $date): bool
    {
        return $this->query->whereDate('date', now()->parse($date))
            ->exists();
    }

    public function getAvailabilitySlot(Slot $appointmentSlot): ?AppointmentAvailabilitySlotModel
    {
        return $this->query->whereAvailabilitySlot($appointmentSlot)
            ->first();
    }

    public function getAvailabilitySlots(string|array|DateTimeInterface $date, ?array $orderBy = null): Collection
    {
        return $this->query->whereAvailabilitySlots($date, $orderBy)
            ->get();
    }
}
