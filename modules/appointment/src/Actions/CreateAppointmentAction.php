<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Actions;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Data\SlotData;
use AppointmentService\Appointment\Events\AvailabilitySlotsCreated;
use AppointmentService\Appointment\Factories\AppointmentAvailabilitySlotCollectionFactory;
use AppointmentService\Appointment\Factories\AppointmentAvailabilitySlotFactory;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Illuminate\Support\Collection;

final class CreateAppointmentAction
{
    public function __invoke(AppointmentSlot $appointmentSlot)
    {
        $this->calculateAvailabilitySlots($appointmentSlot)
            ->each(
                fn (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->save()
            );

        $this->deleteCurrentAppointmentAvailabilitySlot($appointmentSlot->getAppointmentAvailabilitySlot());

        AvailabilitySlotsCreated::dispatch($appointmentSlot);
    }

    private function calculateAvailabilitySlots(AppointmentSlot $appointmentSlot): Collection
    {
        $appointmentConfiguration = $appointmentSlot->getAppointmentConfiguration();

        return $this->from($appointmentSlot)
            ->reduce(fn (Collection $appointmentAvailabilitySlots, AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => (
                $appointmentSlot->isBetween($appointmentAvailabilitySlot->getStart(), $appointmentAvailabilitySlot->getEnd())
                ? $appointmentAvailabilitySlots->push(
                    AppointmentAvailabilitySlotFactory::from(
                        SlotData::from([
                            'start' => $appointmentAvailabilitySlot->getStart(),
                            'end' => $appointmentSlot->getStart(),
                        ])
                    )->make(),
                    AppointmentAvailabilitySlotFactory::from(
                        SlotData::from([
                            'start' => $appointmentSlot->getEnd()->addMinutes(
                                $appointmentConfiguration->next_appointment_threshold_minutes
                            ),
                            'end' => $appointmentAvailabilitySlot->getEnd(),
                        ])
                    )->make(),
                )
                : $appointmentAvailabilitySlots->push($appointmentAvailabilitySlot)
            ), collect());
    }

    private function from(AppointmentSlot $appointmentSlot): Collection
    {
        $appointmentAvailabilitySlot = $appointmentSlot->getAppointmentAvailabilitySlot();

        return match ($appointmentAvailabilitySlot) {
            null => AppointmentAvailabilitySlotCollectionFactory::from($appointmentSlot)->make(),
            default => $appointmentAvailabilitySlot->toCollection(),
        };
    }

    private function deleteCurrentAppointmentAvailabilitySlot(?AppointmentAvailabilitySlot $appointmentAvailabilitySlot): void
    {
        ! $appointmentAvailabilitySlot ?: $appointmentAvailabilitySlot->delete();
    }
}
