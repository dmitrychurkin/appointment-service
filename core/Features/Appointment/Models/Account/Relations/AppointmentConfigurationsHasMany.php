<?php

namespace Core\Features\Appointment\Models\Account\Relations;

use Core\Features\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait AppointmentConfigurationsHasMany
{
    public function appointmentConfigurations(): HasMany
    {
        return $this->hasMany(AppointmentConfiguration::class);
    }
}
