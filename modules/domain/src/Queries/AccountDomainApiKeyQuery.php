<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Queries;

use AppointmentService\Domain\Contracts\Domain;
use AppointmentService\Domain\Contracts\Origin;
use AppointmentService\Domain\Contracts\Repositories\AccountDomain as AccountDomainRepository;
use AppointmentService\Domain\Data\DomainData;

final class AccountDomainApiKeyQuery
{
    public function __construct(
        private readonly AccountDomainRepository $accountDomainRepository
    ) {}

    public function __invoke(Origin $origin): Domain
    {
        return new DomainData(
            value: $this->accountDomainRepository->getAccountDomain($origin),
        );
    }
}
