<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\Appointment;

use AppointmentService\Appointment\Models\Appointment\Relations\UserBelongsTo;

trait AppointmentRelations
{
    use UserBelongsTo;
}
