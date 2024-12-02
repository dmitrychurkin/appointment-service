<?php

namespace Core\Features\Appointment\Http\Controllers\Api\V1;

use Core\Features\Appointment\Attributes\CurrentUser;
use Core\Features\Appointment\Contracts\Services\Appointment as AppointmentService;
use Core\Features\Appointment\Data\AppointmentSlotData;
use Core\Features\Appointment\Http\Requests\UpdateAppointmentRequest;
use Core\Features\Appointment\Models\Appointment\Appointment;
use Core\Features\Appointment\Models\User\User;
use Core\Features\Common\Http\Controllers\Controller;

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
    public function store(AppointmentSlotData $appointmentSlotData, #[CurrentUser] User $user)
    {
        return $this->appointmentService->create(
            $appointmentSlotData
                ->withAccount($user->account)
        );
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
