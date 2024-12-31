<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\User;

use AppointmentService\Appointment\Models\Account\Relations\AppointmentsHasMany;
use AppointmentService\Appointment\Models\User\Relations\AccountBelongsTo;

trait UserRelations
{
    use AccountBelongsTo, AppointmentsHasMany;
}
