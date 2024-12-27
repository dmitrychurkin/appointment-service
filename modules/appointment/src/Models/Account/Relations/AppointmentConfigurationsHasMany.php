<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\Account\Relations;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait AppointmentConfigurationsHasMany
{
    public function appointmentConfigurations(): HasMany
    {
        return $this->hasMany(AppointmentConfiguration::class);
    }
}
