<?php

namespace Core\Features\Appointment\Services;

use Core\Features\Appointment\Actions\CreateAppointmentAction;
use Core\Features\Appointment\Contracts\AppointmentSlot;
use Core\Features\Appointment\Contracts\Services\Appointment;
use Exception;
use Illuminate\Support\Facades\DB;

final class AppointmentService implements Appointment
{
    public function __construct(
        private readonly CreateAppointmentAction $createAppointmentAction
    ) {}

    public function create(AppointmentSlot $appointmentSlot): void
    {
        $execute = $this->createAppointmentAction;

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
