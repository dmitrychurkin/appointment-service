<?php

namespace Core\Features\Appointment\Models\User\Relations;

use Core\Features\Appointment\Models\Account\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait AccountBelongsTo
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
