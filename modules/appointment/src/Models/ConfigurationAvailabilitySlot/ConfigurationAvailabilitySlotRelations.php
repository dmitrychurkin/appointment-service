<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot;

use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\Relations\AppointmentConfigurationBelongsTo;

trait ConfigurationAvailabilitySlotRelations
{
    use AppointmentConfigurationBelongsTo;
}
