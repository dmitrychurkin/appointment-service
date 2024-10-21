<?php

namespace App\Models\Service;

use App\Models\AppointmentAvailabilitySlot;
use App\Models\Contract\Appointment as AppointmentContract;
use App\Models\Data\AppointmentSlot;
use App\Models\Event\CreateAppointment;
use App\Models\Service\AvailabilitySlotManager\AvailabilitySlotManager;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\EventBus;
use Illuminate\Support\Facades\DB;

final class Appointment implements AppointmentContract
{
    public function __construct(
        private EventBus $eventBus
    ) {}

    #[CommandHandler(AppointmentContract::CREATE)]
    public function create(AppointmentSlot $appointmentSlot): void
    {
        DB::transaction(function () use ($appointmentSlot) {
            $appointmentAvailabilitySlot = $this->getAppointmentAvailabilitySlot($appointmentSlot);

            AvailabilitySlotManager::from($appointmentSlot, $appointmentAvailabilitySlot)
                ->execute()
                ->each(
                    fn (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->save()
                );

            $this->eventBus->publish(CreateAppointment::from($appointmentSlot));
        });
    }

    private function getAppointmentAvailabilitySlot(AppointmentSlot $appointmentSlot): ?AppointmentAvailabilitySlot
    {
        return AppointmentAvailabilitySlot::whereHasAvailabilitySlot($appointmentSlot)->first();
    }
}
