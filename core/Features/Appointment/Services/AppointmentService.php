<?php

namespace Core\Features\Appointment\Services;

use Core\Features\Appointment\Contracts\AppointmentUseCase;
use Core\Features\Appointment\Data\AppointmentSlotData;
use Core\Features\Appointment\Services\Commands\CreateAppointmentCommand;

final class AppointmentService implements AppointmentUseCase
{
    public function __construct(
        private readonly CreateAppointmentCommand $createAppointmentCommand
    ) {}

    public function create(AppointmentSlotData $appointmentSlot): void
    {
        $this->createAppointmentCommand->execute($appointmentSlot);
    }
}
