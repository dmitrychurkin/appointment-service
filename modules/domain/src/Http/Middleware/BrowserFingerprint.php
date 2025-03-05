<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Http\Middleware;

use AppointmentService\Common\Http\Response\Response as HttpResponse;
use AppointmentService\Domain\Contracts\Services\BrowserFingerprint as BrowserFingerprintService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class BrowserFingerprint
{
    public const HEADER_NAME = 'X-Fingerprint';

    public function __construct(
        private readonly BrowserFingerprintService $browserFingerprintService
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $browserFingerprint = $request->header(self::HEADER_NAME);

        // If the browser fingerprint is not present, return a 403 Forbidden response.
        if (! $browserFingerprint) {
            return abort(HttpResponse::HTTP_FORBIDDEN);
        }

        // If the browser fingerprint is not stored in the session, store it.
        if (! $this->browserFingerprintService->fingerprint && $browserFingerprint) {
            $this->browserFingerprintService->fingerprint = $browserFingerprint;

            return $next($request);
        }

        // If the browser fingerprint is stored in the session, compare it with the one sent in the request.
        if ($this->browserFingerprintService->compareFingerprint($browserFingerprint)) {
            return $next($request);
        }

        return abort(HttpResponse::HTTP_FORBIDDEN);
    }
}
