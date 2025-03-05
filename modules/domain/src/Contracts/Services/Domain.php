<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Contracts\Services;

use AppointmentService\Domain\Contracts\Domain as DomainContract;
use AppointmentService\Domain\Contracts\Origin;

interface Domain
{
    public function getDomain(Origin $origin): DomainContract;
}
