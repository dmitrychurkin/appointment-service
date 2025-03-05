<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Data;

use AppointmentService\Common\Data\Data;
use AppointmentService\Domain\Contracts\Domain;
use AppointmentService\Domain\Models\AccountDomain\AccountDomain;
use AppointmentService\Domain\Models\DomainApiKey\DomainApiKey;

final class DomainData extends Data implements Domain
{
    public DomainApiKey $domainApiKey {
        get {
        return $this->value->domainApiKeys->firstOrFail();
    }
    }

    public string $key {
        get {
        return $this->domainApiKey->key;
    }
    }

    public function __construct(
        public AccountDomain $value
    ) {}

    public function compareKey(string $key): bool
    {
        return $this->key === $key;
    }
}
