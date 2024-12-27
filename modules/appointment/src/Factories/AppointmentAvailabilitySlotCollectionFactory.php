<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Factories;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Factories\DataFactory;
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
        return $this->appointmentSlot
            ->getConfigurationAvailabilitySlots()
            ->map(
                fn (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) => AppointmentAvailabilitySlotFactory::from(
                    $this->appointmentSlot->newSlotData(
                        start: $configurationAvailabilitySlot->start_time,
                        end: $configurationAvailabilitySlot->end_time
                    )
                )->make()
            );
    }
}
