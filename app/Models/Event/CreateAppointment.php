<?php

namespace App\Models\Event;

use App\Models\Data\AppointmentSlot;

final class CreateAppointment extends AppointmentSlot
{
    public static function fromAppointmentSlot(AppointmentSlot $appointmentSlot): self
    {
        return self::from($appointmentSlot->toArray());
    }
}
