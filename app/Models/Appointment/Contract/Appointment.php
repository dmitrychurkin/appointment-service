<?php

namespace App\Models\Appointment\Contract;

use App\Models\Appointment\Data\AppointmentSlot;
use Ecotone\Messaging\Attribute\BusinessMethod;

interface Appointment
{
    public const string CREATE = 'appointment.create';

    #[BusinessMethod(requestChannel: self::CREATE)]
    public function create(AppointmentSlot $appointmentSlot): void;
}
