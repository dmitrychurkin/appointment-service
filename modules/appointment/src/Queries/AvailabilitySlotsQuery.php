<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Queries;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Factories\AppointmentAvailabilitySlotCollectionFactory;
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
        $availabilitySlots = $this->getAvailabilitySlots($availability);

        return $this->mapAvailabilitySlots($availabilitySlots, $availability)
            ->reduce(function (Collection $slots, AppointmentAvailabilitySlot $availabilitySlot) use ($availability) {
                foreach ($this->generateAvailabilitySlots($availabilitySlot, $availability) as $slot) {
                    $slots->push($slot);
                }

                return $slots;
            }, collect());
    }

    private function getAvailabilitySlots(Availability $availability): Collection
    {
        return $this->appointmentAvailabilitySlotRepository->getAvailabilitySlots(
            date: $availability->getDate(),
            order: ['start']
        );
    }

    private function mapAvailabilitySlots(Collection $availabilitySlots, Availability $availability): Collection
    {
        return $availabilitySlots->when(
            $availabilitySlots->isEmpty(),
            fn () => AppointmentAvailabilitySlotCollectionFactory::from($availability)
                ->withStart($availability->getDate())
                ->withEnd($availability->getDate())
                ->make(),
            fn (Collection $appointmentAvailabilitySlots) => $appointmentAvailabilitySlots->filter(
                fn (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->duration >= $availability->getDuration()
            )
        );
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

            $slot = SlotData::from([
                'start' => $cursor->clone(),
                'end' => $cursor->addMinutes($availability->getDuration())->clone(),
            ]);

            if ($slot->getStart()->isPast()) {
                continue;
            }

            yield $slot;
        }
    }
}
