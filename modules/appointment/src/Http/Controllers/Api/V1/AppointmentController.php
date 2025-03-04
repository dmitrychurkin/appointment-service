<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Http\Controllers\Api\V1;

use AppointmentService\Appointment\Contracts\Services\Appointment as AppointmentService;
use AppointmentService\Appointment\Data\AppointmentSlotData;
use AppointmentService\Appointment\Http\Requests\Appointment\StoreAppointmentRequest;
use AppointmentService\Appointment\Http\Requests\Appointment\UpdateAppointmentRequest;
use AppointmentService\Appointment\Models\Appointment\Appointment;
use AppointmentService\Common\Http\Controllers\Controller;
use AppointmentService\Common\Http\Response\Response;

final class AppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly AppointmentService $appointmentService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $this->appointmentService->create(
            $request->from(AppointmentSlotData::class)
        );

        return response(status: Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
