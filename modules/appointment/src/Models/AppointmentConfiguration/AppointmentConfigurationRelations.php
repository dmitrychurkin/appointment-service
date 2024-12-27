<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration;

use AppointmentService\Appointment\Models\AppointmentConfiguration\Relations\AccountBelongsTo;
use AppointmentService\Appointment\Models\AppointmentConfiguration\Relations\ConfigurationAvailabilitySlotsHasMany;

trait AppointmentConfigurationRelations
{
    use AccountBelongsTo, ConfigurationAvailabilitySlotsHasMany;
}
