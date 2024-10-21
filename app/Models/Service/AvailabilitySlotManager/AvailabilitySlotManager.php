<?php

namespace App\Models\Service\AvailabilitySlotManager;

use App\Models\AppointmentAvailabilitySlot;
use App\Models\Data\AppointmentSlot;
use App\Models\Data\Slot;
use App\Models\Service\AvailabilitySlotManager\Factory\AvailabilitySlot;
use App\Models\Service\AvailabilitySlotManager\Factory\AvailabilitySlots;
use Illuminate\Support\Collection;

final class AvailabilitySlotManager
{
    public static function from(AppointmentSlot $appointmentSlot, array ...$restArgs): self
    {
        return new self($appointmentSlot, ...$restArgs);
    }

    private readonly Collection $availabilitySlots;

    private function __construct(
        private readonly AppointmentSlot $appointmentSlot,
        ?AppointmentAvailabilitySlot $availabilitySlot = null,
    ) {
        $this->withAvailabilitySlot($availabilitySlot);
    }

    public function getAvailabilitySlots(): Collection
    {
        return $this->availabilitySlots;
    }

    public function withAvailabilitySlot(?AppointmentAvailabilitySlot $availabilitySlot = null)
    {
        $this->availabilitySlots = collect([$availabilitySlot]) ?? AvailabilitySlots::from($this->appointmentSlot)->make();

        return $this;
    }

    public function execute(): Collection
    {
        return $this->makeAvailabilitySlots();
    }

    private function makeAvailabilitySlots(): Collection
    {
        $appointmentConfiguration = $this->appointmentSlot->getAppointmentConfiguration();

        return $this->availabilitySlots->flatMap(function (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) use ($appointmentConfiguration) {
            if (! $this->appointmentSlot->isBetween($appointmentAvailabilitySlot->getStart(), $appointmentAvailabilitySlot->getEnd())) {
                return [$appointmentAvailabilitySlot];
            }

            $appointmentAvailabilitySlot->start = $this->appointmentSlot->getEnd()->addMinutes(
                $appointmentConfiguration->nextAppointmentThresholdMinutes
            );

            return [
                AvailabilitySlot::from(
                    new Slot(
                        start: $appointmentAvailabilitySlot->getStart(),
                        end: $this->appointmentSlot->getStart()
                    )
                )->make(),
                $appointmentAvailabilitySlot,
            ];
        });
    }

    /**
     * @deprecated This method is not used anymore.
     */
    private function hasMathOnEdges(): bool
    {
        $matchFound = false;
        $appointmentConfiguration = $this->appointmentSlot->getAppointmentConfiguration();

        $this->availabilitySlots->map(function (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) use ($appointmentConfiguration, &$matchFound) {
            if ($appointmentAvailabilitySlot->getStart()->equalTo($this->appointmentSlot->getStart())) {
                $appointmentAvailabilitySlot->start = $this->appointmentSlot->getEnd()->addMinutes(
                    $appointmentConfiguration->nextAppointmentThresholdMinutes
                );

                $matchFound = true;

                return $appointmentAvailabilitySlot;
            }

            if ($appointmentAvailabilitySlot->getEnd()->equalTo($this->appointmentSlot->getEnd())) {
                $appointmentAvailabilitySlot->end = $this->appointmentSlot->getStart()->subMinutes(
                    $appointmentConfiguration->nextAppointmentThresholdMinutes
                );

                $matchFound = true;

                return $appointmentAvailabilitySlot;
            }

            return $appointmentAvailabilitySlot;
        });

        return $matchFound;
    }
}
