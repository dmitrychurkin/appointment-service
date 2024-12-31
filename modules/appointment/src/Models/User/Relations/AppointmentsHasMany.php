<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\Account\Relations;

use AppointmentService\Appointment\Models\Appointment\Appointment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait AppointmentsHasMany
{
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
