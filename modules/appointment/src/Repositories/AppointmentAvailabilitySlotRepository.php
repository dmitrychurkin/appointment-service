<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Factories\AppointmentAvailabilitySlotCollectionFactory;
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

    public function getAvailabilitySlots(Availability $availability): Collection
    {
        $appointmentAvailabilitySlots = AppointmentAvailabilitySlotModel::whereDate('date', $availability->getDate())
            ->orderBy('start')
            ->get();

        return $appointmentAvailabilitySlots->when(
            $appointmentAvailabilitySlots->isEmpty(),
            fn () => AppointmentAvailabilitySlotCollectionFactory::from($availability)
                ->withStart($availability->getDate())
                ->withEnd($availability->getDate())
                ->make(),
            fn (Collection $appointmentAvailabilitySlots) => $appointmentAvailabilitySlots->filter(
                fn (AppointmentAvailabilitySlotModel $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->duration >= $availability->getDuration()
            )
        );
    }
}
