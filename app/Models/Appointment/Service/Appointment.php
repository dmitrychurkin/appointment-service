<?php

namespace App\Models\Appointment\Service;

use App\Models\Appointment\Aggregate\AvailabilitySlot;
use App\Models\Appointment\Contract\Appointment as AppointmentContract;
use App\Models\Appointment\Data\AppointmentSlot;
use Ecotone\Modelling\Attribute\CommandHandler;
use Illuminate\Support\Facades\DB;

final class Appointment implements AppointmentContract
{
    #[CommandHandler(AppointmentContract::CREATE)]
    public function create(AppointmentSlot $appointmentSlot): void
    {
        DB::transaction(function () use ($appointmentSlot) {
            $availabilitySlot = $this->getAvailabilitySlot($appointmentSlot);

            match ($availabilitySlot) {
                true => $this->createAvailabilitySlot($appointmentSlot),
                default => $this->updateAvailabilitySlot($appointmentSlot, $availabilitySlot),
            };
        });
    }

    private function getAvailabilitySlot(AppointmentSlot $appointmentSlot): true | AvailabilitySlot
    {
        return AvailabilitySlot::doesntExist() ?: AvailabilitySlot::whereHasAvailabilitySlot($appointmentSlot)->firstOrFail();
    }

    private function createAvailabilitySlot(AppointmentSlot $appointmentSlot): void
    {
        // create appointment
    }

    private function updateAvailabilitySlot(AppointmentSlot $appointmentSlot, AvailabilitySlot $availabilitySlot): void
    {
        // update appointment
    }
}
