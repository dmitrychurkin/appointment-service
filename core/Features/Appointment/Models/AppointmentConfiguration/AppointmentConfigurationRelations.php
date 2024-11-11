<?php

namespace Core\Features\Appointment\Models\AppointmentConfiguration;

use Core\Features\Appointment\Models\AppointmentConfiguration\Relations\AccountBelongsTo;
use Core\Features\Appointment\Models\AppointmentConfiguration\Relations\ConfigurationAvailabilitySlotsHasMany;

trait AppointmentConfigurationRelations
{
    use AccountBelongsTo, ConfigurationAvailabilitySlotsHasMany;
}
