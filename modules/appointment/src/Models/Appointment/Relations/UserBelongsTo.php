<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\Appointment\Relations;

use AppointmentService\Appointment\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserBelongsTo
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
