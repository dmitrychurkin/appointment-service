<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\ConfigurationRecurrence\Relations;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait AppointmentConfigurationBelongsTo
{
    public function appointmentConfiguration(): BelongsTo
    {
        return $this->belongsTo(AppointmentConfiguration::class);
    }
}
