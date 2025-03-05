<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\DomainApiKey\Relations;

use AppointmentService\Domain\Models\AccountDomain\AccountDomain;

trait AccountDomainBelongTo
{
    public function accountDomain()
    {
        return $this->belongsTo(AccountDomain::class);
    }
}
