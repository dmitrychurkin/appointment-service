<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Listeners;

use AppointmentService\Appointment\Events\AppointmentCreated;

final class AppointmentEventSubscriber
{
    /**
     * Handle the event.
     */
    public function handleAppointmentCreated(AppointmentCreated $event): void
    {
        //
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(): array
    {
        return [
            AppointmentCreated::class => 'handleAppointmentCreated',
        ];
    }
}
