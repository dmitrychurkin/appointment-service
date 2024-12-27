<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot;

use Illuminate\Database\Eloquent\Builder;

final class AppointmentAvailabilitySlotBuilder extends Builder
{
    use AppointmentAvailabilitySlotQueries;
}
