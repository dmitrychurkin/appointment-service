<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Http\Middleware;

use AppointmentService\Common\Http\Response\Response as HttpResponse;
use AppointmentService\Domain\Contracts\Services\Domain;
use AppointmentService\Domain\Data\OriginData;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class PublicApiKey
{
    public const HEADER_NAME = 'X-Public-Key';

    public function __construct(
        private readonly Domain $domainService
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $publicApiKey = $request->header(self::HEADER_NAME);

        if (! $publicApiKey) {
            return abort(HttpResponse::HTTP_FORBIDDEN);
        }

        $domain = null;

        try {
            $domain = $this->domainService->getDomain(
                new OriginData(
                    value: $request->header('Origin'),
                    key: $publicApiKey
                )
            );
        } catch (ModelNotFoundException) {
            return abort(HttpResponse::HTTP_FORBIDDEN);
        }

        if ($domain->compareKey($publicApiKey)) {
            return abort(HttpResponse::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
