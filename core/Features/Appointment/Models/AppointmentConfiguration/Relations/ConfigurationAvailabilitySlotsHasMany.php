<?php

namespace Core\Features\Appointment\Models\AppointmentConfiguration\Relations;

use Core\Features\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ConfigurationAvailabilitySlotsHasMany
{
    public function configurationAvailabilitySlots(): HasMany
    {
        return $this->hasMany(ConfigurationAvailabilitySlot::class);
    }
}
