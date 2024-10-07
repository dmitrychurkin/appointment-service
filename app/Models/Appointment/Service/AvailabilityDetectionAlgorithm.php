<?php

namespace App\Models\Appointment\Service;

use App\Models\Appointment\Aggregate\AvailabilitySlot;
use App\Models\Appointment\Data\{AppointmentConfiguration, AppointmentSlot};

final class AvailabilityDetectionAlgorithm
{
    public static function boot(array ...$args): self
    {
        return new self(...$args);
    }

    private AvailabilitySlot $availabilitySlot;

    private function __construct(
        private readonly AppointmentSlot $appointmentSlot,
        ?AvailabilitySlot $availabilitySlot = null
    ) {
        $this->availabilitySlot = $availabilitySlot ?? $this->createAvailabilitySlot();
    }

    public function setAvailabilitySlot(AvailabilitySlot $availabilitySlot)
    {
        $this->availabilitySlot = $availabilitySlot;

        return $this;
    }

    public function setAppointmentSlot(AppointmentSlot $appointmentSlot)
    {
        $this->appointmentSlot = $appointmentSlot;

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
        $availabilitySlot = new AvailabilitySlot();

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
