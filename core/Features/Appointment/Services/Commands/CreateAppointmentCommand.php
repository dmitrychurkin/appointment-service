<?php

namespace Core\Features\Appointment\Services\Commands;

use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Core\Features\Common\Contracts\Command;
use Core\Features\Common\Data\Data;
use Core\Features\Common\Data\NullableData;
use Illuminate\Support\Facades\DB;

final class CreateAppointmentCommand implements Command
{
    public function execute(Data $appointmentSlot): Data
    {
        DB::transaction(function () use ($appointmentSlot) {
            $appointmentAvailabilitySlot = AppointmentAvailabilitySlot::whereHasAvailabilitySlot($appointmentSlot)->first();

            AvailabilitySlotManager::from($appointmentSlot, $appointmentAvailabilitySlot)
                ->execute()
                ->each(
                    fn (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->save()
                );

            // $this->eventBus->publish(new CreateAppointment($appointmentSlot));
        });

        return NullableData::from();
    }
}
