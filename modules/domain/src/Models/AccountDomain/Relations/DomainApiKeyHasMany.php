<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\AccountDomain\Relations;

use AppointmentService\Domain\Models\DomainApiKey\DomainApiKey;

trait DomainApiKeyHasMany
{
    public function domainApiKeys()
    {
        return $this->hasMany(DomainApiKey::class);
    }
}
