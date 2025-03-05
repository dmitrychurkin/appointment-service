<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Contracts;

interface Origin
{
    public string $value { get; }

    public ?string $key { get; }
}
