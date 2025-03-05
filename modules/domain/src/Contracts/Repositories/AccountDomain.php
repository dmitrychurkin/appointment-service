<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Contracts\Repositories;

use AppointmentService\Domain\Contracts\Origin;
use AppointmentService\Domain\Models\AccountDomain\AccountDomain as AccountDomainModel;

interface AccountDomain
{
    public function getAccountDomain(Origin $origin): AccountDomainModel;
}
