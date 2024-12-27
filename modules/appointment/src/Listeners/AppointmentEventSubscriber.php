<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Listeners;

use AppointmentService\Appointment\Contracts\Repositories\Appointment as AppointmentRepository;
use AppointmentService\Appointment\Events\AvailabilitySlotsCreated;

final class AppointmentEventSubscriber
{
    public function __construct(
        private readonly AppointmentRepository $appointmentRepository
    ) {}

    /**
     * Handle the event.
     */
    public function handleCreateAppointment(AvailabilitySlotsCreated $event): void
    {
        $this->appointmentRepository->createAppointment($event->appointmentSlot);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(): array
    {
        return [
            AvailabilitySlotsCreated::class => 'handleCreateAppointment',
        ];
    }
}
