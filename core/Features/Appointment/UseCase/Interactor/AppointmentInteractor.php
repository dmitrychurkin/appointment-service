<?php

namespace Core\Features\Appointment\UseCase\Interactor;

use Core\Features\Appointment\Domain\Contracts\AppointmentSlot;
use Core\Features\Appointment\Domain\Services\CreateAppointmentService;
use Core\Features\Appointment\UseCase\Contracts\Appointment;
use Exception;
use Illuminate\Support\Facades\DB;

final class AppointmentInteractor implements Appointment
{
    public function __construct(
        private readonly CreateAppointmentService $createAppointmentService
    ) {}

    public function create(AppointmentSlot $appointmentSlot): void
    {
        $execute = $this->createAppointmentService;

        try {
            DB::beginTransaction();

            $execute($appointmentSlot);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
