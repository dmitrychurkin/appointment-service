<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration\Relations;

use AppointmentService\Appointment\Models\ConfigurationAvailabilitySlot\ConfigurationAvailabilitySlot;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait ConfigurationAvailabilitySlotsHasMany
{
    public function configurationAvailabilitySlots(): HasMany
    {
        return $this->hasMany(ConfigurationAvailabilitySlot::class);
    }
}
