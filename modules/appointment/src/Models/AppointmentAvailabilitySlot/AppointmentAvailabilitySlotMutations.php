<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot;

use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Mutations\DeleteInvalid;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Mutations\SyncDuration;

trait AppointmentAvailabilitySlotMutations
{
    use DeleteInvalid, SyncDuration;
}
