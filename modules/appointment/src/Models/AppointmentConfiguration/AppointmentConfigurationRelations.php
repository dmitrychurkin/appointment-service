<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration;

use AppointmentService\Appointment\Models\AppointmentConfiguration\Relations\AccountBelongsTo;
use AppointmentService\Appointment\Models\AppointmentConfiguration\Relations\ConfigurationAvailabilitySlotsHasMany;
use AppointmentService\Appointment\Models\AppointmentConfiguration\Relations\ConfigurationRecurrenceHasOne;

trait AppointmentConfigurationRelations
{
    use AccountBelongsTo, ConfigurationAvailabilitySlotsHasMany, ConfigurationRecurrenceHasOne;
}
