<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Core\Features\Appointment\Contracts\AppointmentUseCase;
use Core\Features\Appointment\Data\AppointmentSlotData;
use Core\Features\Appointment\Models\Appointment\Appointment;
use Core\Features\Common\Models\User;
use Illuminate\Container\Attributes\CurrentUser;

class AppointmentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private AppointmentUseCase $appointmentUseCase
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
    public function store(StoreAppointmentRequest $request, #[CurrentUser] User $user)
    {
        $this->appointmentUseCase->create(
            AppointmentSlotData::from($request->validated())
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
