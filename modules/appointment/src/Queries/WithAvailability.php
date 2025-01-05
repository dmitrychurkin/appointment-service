<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Queries;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Contracts\SlotConfiguration;
use AppointmentService\Appointment\Contracts\SlotDuration;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Factories\AppointmentAvailabilitySlotCollectionFactory;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Iterator;

trait WithAvailability
{
    abstract private function getAvailabilitySlots(Availability $availability): Collection;

    private function validateSlot(AppointmentAvailabilitySlot $appointmentAvailabilitySlot, SlotDuration $availability): bool
    {
        return $this->validateSlotPast($appointmentAvailabilitySlot->getEnd())
            && $this->validateSlotDuration($appointmentAvailabilitySlot, $availability);
    }

    private function validateSlotPast(Carbon $date): bool
    {
        return ! $date->isPast();
    }

    private function validateSlotDuration(AppointmentAvailabilitySlot $appointmentAvailabilitySlot, SlotDuration $availability): bool
    {
        return $appointmentAvailabilitySlot->duration >= $availability->getDuration();
    }

    private function mapAvailabilitySlots(Collection $availabilitySlotsCollection, SlotConfiguration $availability, Carbon $date): Collection
    {
        return $availabilitySlotsCollection->when(
            $availabilitySlotsCollection->isEmpty(),
            fn () => AppointmentAvailabilitySlotCollectionFactory::from($availability)
                ->withDate($date)
                ->make()
        );
    }

    private function generateAvailabilitySlots(Slot $availabilitySlot, SlotDuration $availability): Iterator
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
