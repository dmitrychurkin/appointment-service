<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Queries;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Illuminate\Support\Collection;

final class AvailabilitySlotsQuery
{
    use WithAvailability;

    public function __construct(
        private readonly AppointmentAvailabilitySlotRepository $appointmentAvailabilitySlotRepository
    ) {}

    public function __invoke(Availability $availability): Collection
    {
        return $this->mapAvailabilitySlots($this->getAvailabilitySlots($availability), $availability, $availability->getDate())
            ->reduce(function (Collection $slots, AppointmentAvailabilitySlot $appointmentAvailabilitySlot) use ($availability) {
                if (! $this->validateSlot($appointmentAvailabilitySlot, $availability)) {
                    return $slots;
                }

                foreach ($this->generateAvailabilitySlots($appointmentAvailabilitySlot, $availability) as $slot) {
                    $slots->push($slot);
                }

                return $slots;
            }, collect());
    }

    private function getAvailabilitySlots(Availability $availability): Collection
    {
        return $this->appointmentAvailabilitySlotRepository->getAvailabilitySlots(
            date: $availability->getDate(),
            orderBy: ['start'],
        );
    }
}
