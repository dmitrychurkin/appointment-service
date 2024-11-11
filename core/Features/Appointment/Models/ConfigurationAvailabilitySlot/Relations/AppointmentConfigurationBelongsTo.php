<?php

namespace Core\Features\Appointment\Models\ConfigurationAvailabilitySlot\Relations;

use Core\Features\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait AppointmentConfigurationBelongsTo
{
    public function appointmentConfiguration(): BelongsTo
    {
        return $this->belongsTo(AppointmentConfiguration::class);
    }
}
