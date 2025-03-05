<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Contracts\Services;

interface BrowserFingerprint
{
    public function getFingerprint(): ?string;

    public function setFingerprint(string $fingerprint): void;

    public function compareFingerprint(string $fingerprint): bool;
}
