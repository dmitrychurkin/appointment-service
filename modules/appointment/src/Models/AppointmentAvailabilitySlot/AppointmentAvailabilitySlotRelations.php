<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot;

use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Relations\AccountBelongsTo;

trait AppointmentAvailabilitySlotRelations
{
    use AccountBelongsTo;
}
