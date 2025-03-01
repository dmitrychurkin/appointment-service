<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationRecurrence;

use AppointmentService\Appointment\Models\ConfigurationRecurrence\Relations\AppointmentConfigurationBelongsTo;

trait ConfigurationRecurrenceRelations
{
    use AppointmentConfigurationBelongsTo;
}
