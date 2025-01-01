<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Queries;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Iterator;

final class AvailabilitySlotsQuery
{
    public function __construct(
        private readonly AppointmentAvailabilitySlotRepository $appointmentAvailabilitySlotRepository
    ) {}

    public function __invoke(Availability $availability): Collection
    {
        return $this->appointmentAvailabilitySlotRepository->getAvailabilitySlots($availability)
            ->reduce(function (Collection $slots, AppointmentAvailabilitySlot $availabilitySlot) use ($availability) {
                foreach ($this->generateAvailabilitySlots($availabilitySlot, $availability) as $slot) {
                    $slots->push($slot);
                }

                return $slots;
            }, collect());
    }

    private function generateAvailabilitySlots(AppointmentAvailabilitySlot $availabilitySlot, Availability $availability): Iterator
    {
        $cursor = $availabilitySlot->getStart();
        $assertEdgeOverflow = fn (Carbon $cursor) => (
            $cursor->addMinutes($availability->getDuration())
                ->greaterThan($availabilitySlot->getEnd())
        );

        while ($cursor->lessThan($availabilitySlot->getEnd())) {
            if ($assertEdgeOverflow($cursor->clone())) {
                break;
            }

            yield SlotData::from([
                'start' => $cursor->clone(),
                'end' => $cursor->addMinutes($availability->getDuration())->clone(),
            ]);
        }
    }
}
