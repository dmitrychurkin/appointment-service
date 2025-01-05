<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Controllers\Api\V1;

use AppointmentService\Appointment\Contracts\Services\Availability as AvailabilityService;
use AppointmentService\Appointment\Data\AvailabilityData;
use AppointmentService\Appointment\Http\Requests\Availability\GetAvailabilityRequest;
use AppointmentService\Appointment\Http\Resources\Availability\AvailabilityCollection;
use AppointmentService\Common\Http\Controllers\Controller;

final class AvailabilityController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly AvailabilityService $availabilityService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(GetAvailabilityRequest $request)
    {
        return response()->json([
            'data' => $this->availabilityService->getAvailability(
                $request->from(AvailabilityData::class)
            ),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function slots(GetAvailabilityRequest $request)
    {
        return AvailabilityCollection::make(
            $this->availabilityService->getAvailabilitySlots(
                $request->from(AvailabilityData::class)
            )
        );
    }
}
