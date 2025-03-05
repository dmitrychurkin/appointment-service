<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Services;

use AppointmentService\Domain\Contracts\Domain as DomainContract;
use AppointmentService\Domain\Contracts\Origin;
use AppointmentService\Domain\Contracts\Services\Domain;
use AppointmentService\Domain\Queries\AccountDomainApiKeyQuery;

final class DomainService implements Domain
{
    public function __construct(
        private readonly AccountDomainApiKeyQuery $accountDomainApiKeyQuery,
    ) {}

    public function getDomain(Origin $origin): DomainContract
    {
        $execute = $this->accountDomainApiKeyQuery;

        return $execute($origin);
    }
}
