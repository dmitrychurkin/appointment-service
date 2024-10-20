<?php

namespace App\Models\Service;

use App\Models\AppointmentAvailabilitySlot;
use App\Models\Contract\Appointment as AppointmentContract;
use App\Models\Data\AppointmentSlot;
use App\Models\Service\AvailabilitySlotManager\AvailabilitySlotManager;
use Ecotone\Modelling\Attribute\CommandHandler;
use Illuminate\Support\Facades\DB;

final class Appointment implements AppointmentContract
{
    #[CommandHandler(AppointmentContract::CREATE)]
    public function create(AppointmentSlot $appointmentSlot): void
    {
        DB::transaction(function () use ($appointmentSlot) {
            $appointmentAvailabilitySlot = $this->getAppointmentAvailabilitySlot($appointmentSlot);

            $availabilitySlotManager = match ($appointmentAvailabilitySlot) {
                true => AvailabilitySlotManager::from($appointmentSlot),
                default => AvailabilitySlotManager::from($appointmentSlot, $availabilitySlot),
            };

            $availabilitySlotManager->execute()->each(
                fn (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->save()
            );

            // TODO: Dispatch event to finalize and create the appointment
            // send notification to the user
        });
    }

    private function getAppointmentAvailabilitySlot(AppointmentSlot $appointmentSlot): true|AppointmentAvailabilitySlot
    {
        return AppointmentAvailabilitySlot::doesntExist() ?: AppointmentAvailabilitySlot::whereHasAvailabilitySlot($appointmentSlot)->firstOrFail();
    }
}
