<?php

namespace App\Models\Service\AvailabilitySlotManager\Factory;

use App\Models\ConfigurationAvailabilitySlot;
use App\Models\Data\AppointmentSlot;
use Illuminate\Support\Collection;

final class AvailabilitySlots
{
    public static function from(AppointmentSlot $appointmentSlot): self
    {
        return new self($appointmentSlot);
    }

    private function __construct(
        private readonly AppointmentSlot $appointmentSlot
    ) {}

    public function make(): Collection
    {
        $appointmentSlot = $this->appointmentSlot;

        return $appointmentSlot
            ->getConfigurationAvailabilitySlots()
            ->map(
                fn (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) => AvailabilitySlot::from(
                    start: $appointmentSlot->getStart()->setTimeFrom($configurationAvailabilitySlot->startTime),
                    end: $appointmentSlot->getEnd()->setTimeFrom($configurationAvailabilitySlot->endTime)
                )->make()
            );
    }
}
