<?php

namespace App\Models\Subscriber;

use App\Models\Appointment as AppointmentModel;
use App\Models\Event\CreateAppointment;
use Ecotone\Modelling\Attribute\EventHandler;

final class Appointment
{
    #[EventHandler]
    public function createAppointment(CreateAppointment $createAppointment): void
    {
        AppointmentModel::create($createAppointment->toArray());

        // Send email to the subscriber
    }
}
