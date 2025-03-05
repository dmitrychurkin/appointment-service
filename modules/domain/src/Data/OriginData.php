<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Data;

use AppointmentService\Common\Data\Data;
use AppointmentService\Domain\Contracts\Origin;

final class OriginData extends Data implements Origin
{
    public function __construct(
        public string $value,
        public ?string $key = null
    ) {}
}
