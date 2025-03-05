<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\AccountDomain\Relations;

use AppointmentService\Domain\Models\DomainApiKey\DomainApiKey;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait DomainApiKeyHasOne
{
    public function domainApiKey(): HasOne
    {
        return $this->hasOne(DomainApiKey::class);
    }
}
