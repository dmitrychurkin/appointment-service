<?php

namespace Core\Features\Appointment\Models\ConfigurationAvailabilitySlot;

use Core\Features\Appointment\Models\ConfigurationAvailabilitySlot\Relations\AppointmentConfigurationBelongsTo;

trait ConfigurationAvailabilitySlotRelations
{
    use AppointmentConfigurationBelongsTo;
}
