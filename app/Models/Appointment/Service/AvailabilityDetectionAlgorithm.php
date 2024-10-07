<?php

namespace App\Models\Appointment\Service;

use App\Models\Appointment\Aggregate\AvailabilitySlot;
use App\Models\Appointment\Data\AppointmentConfiguration;
use App\Models\Appointment\Data\AppointmentSlot;

final class AvailabilityDetectionAlgorithm
{
    public static function init(AppointmentSlot $appointmentSlot, array ...$restArgs): self
    {
        return new self($appointmentSlot, ...$restArgs);
    }

    private AvailabilitySlot $availabilitySlot;

    private function __construct(
        private readonly AppointmentSlot $appointmentSlot,
        ?AvailabilitySlot $availabilitySlot = null
    ) {
        $this->withAvailabilitySlot($availabilitySlot);
    }

    public function withAvailabilitySlot(?AvailabilitySlot $availabilitySlot = null)
    {
        $this->availabilitySlot = $availabilitySlot ?? $this->createAvailabilitySlot();

        return $this;
    }

    public function execute()
    {
        // execute algorithm
    }

    private function getAppointmentConfiguration(): AppointmentConfiguration
    {
        return $this->appointmentSlot->configuration;
    }

    private function createAvailabilitySlot(): AvailabilitySlot
    {
        $appointmentConfiguration = $this->getAppointmentConfiguration();
        $availabilitySlot = new AvailabilitySlot;

        $availabilitySlot->from = $this->appointmentSlot
            ->start
            ->startOfDay()
            ->addMinutes($appointmentConfiguration->nextAppointmentThresholdMinutes);

        $availabilitySlot->to = $this->appointmentSlot
            ->end
            ->endOfDay();

        return $availabilitySlot;
    }
}
