<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Contracts;

use AppointmentService\Domain\Models\AccountDomain\AccountDomain;
use AppointmentService\Domain\Models\DomainApiKey\DomainApiKey;

interface Domain
{
    public AccountDomain $value { get; }

    public DomainApiKey $domainApiKey { get; }

    public string $key { get; }

    public function compareKey(string $key): bool;
}
