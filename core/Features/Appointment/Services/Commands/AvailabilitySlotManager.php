<?php

namespace Core\Features\Appointment\Services\Commands;

use Core\Features\Appointment\Data\AppointmentSlotData;
use Core\Features\Appointment\Data\SlotData;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories\AppointmentAvailabilitySlotCollectionFactory;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories\AppointmentAvailabilitySlotFactory;
use Illuminate\Support\Collection;

final class AvailabilitySlotManager
{
    public static function from(AppointmentSlotData $appointmentSlot, array ...$restArgs): self
    {
        return new self($appointmentSlot, ...$restArgs);
    }

    private readonly Collection $availabilitySlots;

    private function __construct(
        private readonly AppointmentSlotData $appointmentSlot,
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
        $this->availabilitySlots = collect([$availabilitySlot]) ?? AppointmentAvailabilitySlotCollectionFactory::from($this->appointmentSlot)->make();

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
                AppointmentAvailabilitySlotFactory::from(
                    new SlotData(
                        start: $appointmentAvailabilitySlot->getStart(),
                        end: $this->appointmentSlot->getStart()->subMinutes(
                            $appointmentConfiguration->nextAppointmentThresholdMinutes
                        )
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
