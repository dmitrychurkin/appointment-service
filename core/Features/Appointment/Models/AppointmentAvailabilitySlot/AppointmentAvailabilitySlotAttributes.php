<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot;

use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Attributes\isInvalid;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Attributes\Slots;

trait AppointmentAvailabilitySlotAttributes
{
    use isInvalid, Slots;
}
