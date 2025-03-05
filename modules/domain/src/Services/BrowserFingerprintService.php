<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Services;

use AppointmentService\Domain\Contracts\Services\BrowserFingerprint;

final class BrowserFingerprintService implements BrowserFingerprint
{
    private const SESSION_KEY = 'browser_fingerprint';

    public ?string $fingerprint {
        get {
        return session(self::SESSION_KEY);
    }
    set {
        session([self::SESSION_KEY => $value]);
    }
    }

    public function setFingerprint(string $fingerprint): void
    {
        $this->fingerprint = $fingerprint;
    }

    public function compareFingerprint(string $fingerprint): bool
    {
        return $this->fingerprint === $fingerprint;
    }
}
