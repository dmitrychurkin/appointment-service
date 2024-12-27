<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\Account;

use AppointmentService\Appointment\Models\Account\Relations\AppointmentConfigurationsHasMany;

trait AccountRelations
{
    use AppointmentConfigurationsHasMany;
}
