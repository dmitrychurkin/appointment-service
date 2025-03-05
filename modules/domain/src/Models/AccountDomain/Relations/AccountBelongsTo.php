<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\AccountDomain\Relations;

use AppointmentService\Common\Models\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait AccountBelongsTo
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
