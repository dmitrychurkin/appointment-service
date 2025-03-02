<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Relations;

use AppointmentService\Appointment\Models\Account\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait AccountBelongsTo
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
