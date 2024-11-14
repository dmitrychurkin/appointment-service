<?php

namespace Core\Features\Appointment\UseCase\Interactor;

use Core\Features\Appointment\UseCase\Commands\CreateAppointmentCommand;
use Core\Features\Appointment\UseCase\Contracts\Data\AppointmentSlot;
use Core\Features\Appointment\UseCase\Contracts\InputPort\Appointment;

final class AppointmentInteractor implements Appointment
{
    public function __construct(
        private readonly CreateAppointmentCommand $createAppointmentCommand
    ) {}

    public function create(AppointmentSlot $appointmentSlot): void
    {
        $this->createAppointmentCommand->execute($appointmentSlot);
    }
}
