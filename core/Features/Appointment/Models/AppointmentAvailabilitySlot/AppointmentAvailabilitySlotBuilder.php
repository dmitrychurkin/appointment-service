<?php

namespace Core\Features\Appointment\Models\AppointmentAvailabilitySlot;

use Illuminate\Database\Eloquent\Builder;

final class AppointmentAvailabilitySlotBuilder extends Builder
{
    use AppointmentAvailabilitySlotQueries;
}
