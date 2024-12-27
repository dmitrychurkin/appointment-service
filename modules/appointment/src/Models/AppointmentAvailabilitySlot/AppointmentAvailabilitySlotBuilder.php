<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot;

use AppointmentService\Common\Builders\QueryBuilder;

final class AppointmentAvailabilitySlotBuilder extends QueryBuilder
{
    use AppointmentAvailabilitySlotQueries;
}
