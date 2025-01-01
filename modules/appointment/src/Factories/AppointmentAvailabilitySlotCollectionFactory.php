<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Factories;

use AppointmentService\Appointment\Concerns\WithSlot;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Contracts\SlotConfiguration;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Factories\DataFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotCollectionFactory extends DataFactory
{
    use WithSlot;

    public static function fromAppointmentConfiguration(SlotConfiguration $appointmentConfiguration): self
    {
        return new self($appointmentConfiguration);
    }

    private readonly Carbon $start;

    private readonly Carbon $end;

    private function __construct(
        private readonly SlotConfiguration $appointmentConfiguration
    ) {}

    public function withSlot(Slot $appointmentSlot): self
    {
        $this->start = $appointmentSlot->getStart();
        $this->end = $appointmentSlot->getEnd();

        return $this;
    }

    public function withStart(Carbon $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function withEnd(Carbon $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function make(): Collection
    {
        return $this->appointmentConfiguration
            ->getConfigurationAvailabilitySlots($this->start)
            ->map(
                fn (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) => AppointmentAvailabilitySlotFactory::from(
                    SlotData::from([
                        'start' => $configurationAvailabilitySlot->start_time
                            ->setDateFrom($this->start),
                        'end' => $configurationAvailabilitySlot->end_time
                            ->setDateFrom($this->end),
                    ])
                )->make()
            );
    }
}
