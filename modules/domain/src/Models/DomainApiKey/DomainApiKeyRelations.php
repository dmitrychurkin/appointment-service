<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\DomainApiKey;

use AppointmentService\Domain\Models\DomainApiKey\Relations\AccountDomainBelongTo;

trait DomainApiKeyRelations
{
    use AccountDomainBelongTo;
}
