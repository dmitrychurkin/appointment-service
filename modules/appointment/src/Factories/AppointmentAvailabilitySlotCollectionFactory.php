<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Factories;

use AppointmentService\Appointment\Concerns\WithSlot;
use AppointmentService\Appointment\Contracts\SlotConfiguration;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use AppointmentService\Common\Factories\DataFactory;
use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotCollectionFactory extends DataFactory
{
    use WithSlot;

    public static function fromAppointmentConfiguration(SlotConfiguration $appointmentConfiguration): self
    {
        return new self($appointmentConfiguration);
    }

    private readonly Carbon $date;

    private function __construct(
        private readonly SlotConfiguration $appointmentConfiguration
    ) {}

    public function withDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function make(): Collection
    {
        return $this->appointmentConfiguration
            ->selectConfigurationAvailabilitySlots($this->date)
            ->map(
                fn (ConfigurationAvailabilitySlot $configurationAvailabilitySlot) => AppointmentAvailabilitySlotFactory::from(
                    SlotData::from([
                        'start' => $configurationAvailabilitySlot->start_time
                            ->setDateFrom($this->date),
                        'end' => $configurationAvailabilitySlot->end_time
                            ->setDateFrom($this->date),
                    ])
                )->make()
            );
    }
}
