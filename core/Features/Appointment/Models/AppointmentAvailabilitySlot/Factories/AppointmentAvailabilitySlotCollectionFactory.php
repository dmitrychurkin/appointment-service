<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories;

use Core\Features\Appointment\Domain\Contracts\AppointmentSlot;
use Core\Features\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use Core\Features\Common\Factories\DataFactory;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotCollectionFactory extends DataFactory
{
    public static function fromAppointmentSlot(AppointmentSlot $appointmentSlot): self
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
                fn (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) => AppointmentAvailabilitySlotFactory::from(
                    start: $appointmentSlot->setStartTimeFrom($configurationAvailabilitySlot->startTime),
                    end: $appointmentSlot->setEndTimeFrom($configurationAvailabilitySlot->endTime)
                )->make()
            );
    }
}
