<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Queries;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final class AvailabilityQuery
{
    use WithAvailability;

    public function __construct(
        private readonly AppointmentAvailabilitySlotRepository $appointmentAvailabilitySlotRepository
    ) {}

    public function __invoke(Availability $availability): Collection
    {
        $availability->getConfigurationAvailabilitySlots([
            $availability->getStart(),
            $availability->getEnd(),
        ]);

        $availabilitySlots = $this->getAvailabilitySlots($availability);

        $collection = collect();

        $cursor = $availability->getStart();

        while ($cursor->lessThanOrEqualTo($availability->getEnd())) {
            [$availabilitySlotsCollection, $availabilitySlots] = $this->findAvailabilitySlots($availabilitySlots, $cursor);

            $count = $this->mapAvailabilitySlots($availabilitySlotsCollection, $availability, $cursor)
                ->reduce(function (int $counter, AppointmentAvailabilitySlot $appointmentAvailabilitySlot) use ($availability) {
                    if (! $this->validateSlot($appointmentAvailabilitySlot, $availability)) {
                        return $counter;
                    }

                    return $counter + collect($this->generateAvailabilitySlots($appointmentAvailabilitySlot, $availability))
                        ->sum(fn () => 1);
                }, 0);

            $collection->put($cursor->toDateString(), $count);

            $cursor->addDay();
        }

        return $collection;
    }

    private function findAvailabilitySlots(Collection $availabilitySlots, Carbon $date): array
    {
        $collection = collect();
        $first = $availabilitySlots->first();

        if (! $first?->date->isSameDay($date)) {
            return [
                $collection,
                $availabilitySlots,
            ];
        }

        $offset = 0;

        foreach ($availabilitySlots as $availabilitySlot) {
            if ($availabilitySlot->date->isSameDay($date)) {
                $offset += 1;
                $collection->push($availabilitySlot);

                continue;
            }

            break;
        }

        return [
            $collection,
            $availabilitySlots->slice($offset),
        ];
    }

    private function getAvailabilitySlots(Availability $availability): Collection
    {
        return $this->appointmentAvailabilitySlotRepository->getAvailabilitySlots(
            date: [
                $availability->getStart(),
                $availability->getEnd(),
            ],
            orderBy: ['start'],
        );
    }
}
