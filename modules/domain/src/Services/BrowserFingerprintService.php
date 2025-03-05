<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Services;

use AppointmentService\Domain\Contracts\Services\BrowserFingerprint;

final class BrowserFingerprintService implements BrowserFingerprint
{
    private const SESSION_KEY = 'browser_fingerprint';

    public function getFingerprint(): ?string
    {
        return session(self::SESSION_KEY);
    }

    public function setFingerprint(string $fingerprint): void
    {
        session([self::SESSION_KEY => $fingerprint]);
    }

    public function compareFingerprint(string $fingerprint): bool
    {
        return $this->getFingerprint() === $fingerprint;
    }
}
