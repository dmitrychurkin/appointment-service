<?php

namespace Core\Features\Appointment\Models\Account;

use Core\Features\Appointment\Models\Account\Relations\AppointmentConfigurationsHasMany;

trait AccountRelations
{
    use AppointmentConfigurationsHasMany;
}
