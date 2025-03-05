<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Http\Controllers\Api\V1;

use AppointmentService\Common\Http\Controllers\Controller;
use AppointmentService\Common\Http\Response\Response;
use AppointmentService\Domain\Contracts\Services\Domain;
use AppointmentService\Domain\Data\OriginData;
use AppointmentService\Domain\Http\Middleware\PublicApiKey;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ItemNotFoundException;

final class AccountDomainController extends Controller
{
    public function __construct(
        private readonly Domain $domainService,
    ) {}

    public function __invoke()
    {
        try {
            $request = request();

            $domain = $this->domainService->getDomain(
                new OriginData(
                    value: $request->header('Origin'),
                )
            );

            return response(
                status: $request->user()
                    ? Response::HTTP_OK
                    : Response::HTTP_NO_CONTENT,
                headers: [
                    PublicApiKey::HEADER_NAME => $domain->key,
                ]
            );
        } catch (ModelNotFoundException|ItemNotFoundException) {
            return response(status: Response::HTTP_FORBIDDEN);
        }
    }
}
