<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Services;

use AppointmentService\Appointment\Actions\CreateAppointmentAction;
use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Contracts\Services\Appointment;
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
