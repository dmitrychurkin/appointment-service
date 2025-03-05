<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Repositories;

use AppointmentService\Common\Attributes\CurrentAccount;
use AppointmentService\Common\Concerns\Repository;
use AppointmentService\Common\Models\Account;
use AppointmentService\Domain\Contracts\Origin;
use AppointmentService\Domain\Contracts\Repositories\AccountDomain;
use AppointmentService\Domain\Models\AccountDomain\AccountDomain as AccountDomainModel;

final class AccountDomainRepository implements AccountDomain
{
    use Repository;

    public function __construct(
        private readonly AccountDomain $model,
        #[CurrentAccount] private readonly Account $account
    ) {}

    public function getAccountDomain(Origin $origin): AccountDomainModel
    {
        return $this->query
            ->whereBelongsTo($this->account)
            ->where('domain', $origin->domain)
            ->firstOrFail();
    }
}
