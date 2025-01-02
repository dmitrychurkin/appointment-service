<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Queries;

use AppointmentService\Appointment\Contracts\AvailabilitySlots as AvailabilitySlotsData;
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

    public function __invoke(AvailabilitySlotsData $availabilitySlotsData): Collection
    {
        return $this->mapAvailabilitySlots($this->getAvailabilitySlots($availabilitySlotsData), $availabilitySlotsData)
            ->reduce(function (Collection $slots, AppointmentAvailabilitySlot $appointmentAvailabilitySlot) use ($availabilitySlotsData) {
                foreach ($this->generateAvailabilitySlots($appointmentAvailabilitySlot, $availabilitySlotsData) as $slot) {
                    $slots->push($slot);
                }

                return $slots;
            }, collect());
    }

    private function getAvailabilitySlots(AvailabilitySlotsData $availabilitySlotsData): Collection
    {
        return $this->appointmentAvailabilitySlotRepository->getAvailabilitySlots(
            date: $availabilitySlotsData->getDate(),
            order: ['start']
        );
    }

    private function mapAvailabilitySlots(Collection $availabilitySlotsCollection, AvailabilitySlotsData $availabilitySlotsData): Collection
    {
        return $availabilitySlotsCollection->when(
            $availabilitySlotsCollection->isEmpty(),
            fn () => AppointmentAvailabilitySlotCollectionFactory::from($availabilitySlotsData)
                ->withStart($availabilitySlotsData->getDate())
                ->withEnd($availabilitySlotsData->getDate())
                ->make(),
            fn (Collection $appointmentAvailabilitySlots) => $appointmentAvailabilitySlots->filter(
                fn (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->duration >= $availabilitySlotsData->getDuration()
            )
        );
    }

    private function generateAvailabilitySlots(AppointmentAvailabilitySlot $availabilitySlot, AvailabilitySlotsData $availabilitySlotsData): Iterator
    {
        $cursor = $availabilitySlot->getStart();
        $assertEdgeOverflow = fn (Carbon $cursor) => (
            $cursor->addMinutes($availabilitySlotsData->getDuration())
                ->greaterThan($availabilitySlot->getEnd())
        );

        while ($cursor->lessThan($availabilitySlot->getEnd())) {
            if ($assertEdgeOverflow($cursor->clone())) {
                break;
            }

            $slot = SlotData::from([
                'start' => $cursor->clone(),
                'end' => $cursor->addMinutes($availabilitySlotsData->getDuration())->clone(),
            ]);

            if ($slot->getStart()->isPast()) {
                continue;
            }

            yield $slot;
        }
    }
}
