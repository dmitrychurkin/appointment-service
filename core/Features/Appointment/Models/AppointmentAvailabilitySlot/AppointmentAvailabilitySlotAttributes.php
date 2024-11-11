<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot;

use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Attributes\IsInvalid;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Attributes\Slots;

trait AppointmentAvailabilitySlotAttributes
{
    use IsInvalid, Slots;
}
