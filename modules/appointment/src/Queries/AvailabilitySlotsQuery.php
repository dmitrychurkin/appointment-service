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
        return $this->mapAvailabilitySlots($this->getAvailabilitySlots($availability), $availability)
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

    private function validateSlot(AppointmentAvailabilitySlot $appointmentAvailabilitySlot, Availability $availability): bool
    {
        return $this->validateSlotPast($appointmentAvailabilitySlot->getEnd())
            && $this->validateSlotDuration($appointmentAvailabilitySlot, $availability);
    }

    private function validateSlotPast(Carbon $date): bool
    {
        return ! $date->isPast();
    }

    private function validateSlotDuration(AppointmentAvailabilitySlot $appointmentAvailabilitySlot, Availability $availability): bool
    {
        return $appointmentAvailabilitySlot->duration >= $availability->getDuration();
    }

    private function getAvailabilitySlots(Availability $availability): Collection
    {
        return $this->appointmentAvailabilitySlotRepository->getAvailabilitySlots(
            date: $availability->getDate(),
            orderBy: ['start']
        );
    }

    private function mapAvailabilitySlots(Collection $availabilitySlotsCollection, Availability $availability): Collection
    {
        return $availabilitySlotsCollection->when(
            $availabilitySlotsCollection->isEmpty(),
            fn () => AppointmentAvailabilitySlotCollectionFactory::from($availability)
                ->withDate($availability->getDate())
                ->make()
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
