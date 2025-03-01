<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration\Relations;

use AppointmentService\Appointment\Models\ConfigurationRecurrence\ConfigurationRecurrence;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait ConfigurationRecurrenceHasOne
{
    public function configurationRecurrence(): HasOne
    {
        return $this->hasOne(ConfigurationRecurrence::class);
    }
}
