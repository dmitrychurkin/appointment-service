<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Factories;

use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Contracts\SlotConfiguration;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Factories\DataFactory;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotCollectionFactory extends DataFactory
{
    public static function fromAppointmentSlot(SlotConfiguration&Slot $appointmentSlot): self
    {
        return new self($appointmentSlot);
    }

    private function __construct(
        private readonly SlotConfiguration&Slot $appointmentSlot
    ) {}

    public function make(): Collection
    {
        return $this->appointmentSlot
            ->getConfigurationAvailabilitySlots()
            ->map(
                fn (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) => AppointmentAvailabilitySlotFactory::from(
                    SlotData::from([
                        'start' => $configurationAvailabilitySlot->start_time
                            ->setDateFrom($this->appointmentSlot->getStart()),
                        'end' => $configurationAvailabilitySlot->end_time
                            ->setDateFrom($this->appointmentSlot->getEnd()),
                    ])
                )->make()
            );
    }
}
