<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories;

use Core\Features\Appointment\Data\AppointmentSlotData;
use Core\Features\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use Core\Features\Common\Factories\DataFactory;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotCollectionFactory extends DataFactory
{
    public static function fromAppointmentSlot(AppointmentSlotData $appointmentSlot): self
    {
        return new self($appointmentSlot);
    }

    private function __construct(
        private readonly AppointmentSlotData $appointmentSlot
    ) {}

    public function make(): Collection
    {
        $appointmentSlot = $this->appointmentSlot;

        return $appointmentSlot
            ->getConfigurationAvailabilitySlots()
            ->map(
                fn (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) => AppointmentAvailabilitySlotFactory::from(
                    start: $appointmentSlot->getStart()->setTimeFrom($configurationAvailabilitySlot->startTime),
                    end: $appointmentSlot->getEnd()->setTimeFrom($configurationAvailabilitySlot->endTime)
                )->make()
            );
    }
}
