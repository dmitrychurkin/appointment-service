<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Contracts\Services;

interface BrowserFingerprint
{
    public ?string $fingerprint {
        get;
    }

    public function setFingerprint(string $fingerprint): void;

    public function compareFingerprint(string $fingerprint): bool;
}
