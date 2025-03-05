<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\AccountDomain;

use AppointmentService\Domain\Models\AccountDomain\Relations\AccountBelongsTo;
use AppointmentService\Domain\Models\AccountDomain\Relations\DomainApiKeyHasOne;

trait AccountDomainRelations
{
    use AccountBelongsTo, DomainApiKeyHasOne;
}
