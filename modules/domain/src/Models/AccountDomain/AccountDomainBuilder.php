<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\AccountDomain;

use AppointmentService\Common\Builders\QueryBuilder;

final class AccountDomainBuilder extends QueryBuilder
{
    use AccountDomainQueries;
}
