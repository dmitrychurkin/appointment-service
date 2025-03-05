<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Contracts;

use AppointmentService\Domain\Models\AccountDomain\AccountDomain;

interface Domain
{
    public AccountDomain $value { get; }

    public string $key { get; }

    public function compareKey(string $key): bool;
}
