<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

final class AppointmentSlotData extends SlotData implements AppointmentSlot
{
    public function __construct(
        public Carbon $start,
        public Carbon $end,
        public readonly string $title,
        public readonly AppointmentConfiguration $appointmentConfiguration,
        public readonly ?AppointmentAvailabilitySlot $appointmentAvailabilitySlot = null
    ) {
        parent::__construct($start, $end);
    }

    public function getAppointmentAvailabilitySlot(): ?AppointmentAvailabilitySlot
    {
        return $this->appointmentAvailabilitySlot;
    }

    public function getAppointmentConfiguration(): AppointmentConfiguration
    {
        return $this->appointmentConfiguration;
    }

    public function getConfigurationAvailabilitySlots(): Collection
    {
        return $this->getAppointmentConfiguration()
            ->configurationAvailabilitySlots;
    }
}
