<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Factories;

use AppointmentService\Appointment\Contracts\SlotConfiguration;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Factories\DataFactory;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotCollectionFactory extends DataFactory
{
    public static function fromAppointmentSlot(SlotConfiguration $appointmentSlot): self
    {
        return new self($appointmentSlot);
    }

    private function __construct(
        private readonly SlotConfiguration $appointmentSlot
    ) {}

    public function make(): Collection
    {
        return $this->appointmentSlot
            ->getConfigurationAvailabilitySlots()
            ->map(
                fn (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) => AppointmentAvailabilitySlotFactory::from(
                    SlotData::from([
                        'start' => $configurationAvailabilitySlot->start_time,
                        'end' => $configurationAvailabilitySlot->end_time,
                    ])
                )->make()
            );
    }
}
