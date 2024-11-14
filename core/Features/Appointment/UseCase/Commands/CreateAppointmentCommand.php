<?php

namespace Core\Features\Appointment\UseCase\Commands;

use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories\AppointmentAvailabilitySlotCollectionFactory;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories\AppointmentAvailabilitySlotFactory;
use Core\Features\Appointment\UseCase\Contracts\Data\AppointmentSlot;
use Core\Features\Common\Data\NullableData;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class CreateAppointmentCommand
{
    public function execute(AppointmentSlot $appointmentSlot)
    {
        try {
            DB::beginTransaction();
            $appointmentAvailabilitySlot = AppointmentAvailabilitySlot::whereHasAvailabilitySlot($appointmentSlot)->first();

            $this->calculateAvailabilitySlots($appointmentSlot, $appointmentAvailabilitySlot)
                ->each(
                    fn (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->save()
                );

            // $this->eventBus->publish(new CreateAppointment($appointmentSlot));
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return NullableData::from();
    }

    private function withAppointmentAvailabilitySlot(AppointmentSlot $appointmentSlot, ?AppointmentAvailabilitySlot $appointmentAvailabilitySlot): Collection
    {
        return match ($appointmentAvailabilitySlot) {
            null => AppointmentAvailabilitySlotCollectionFactory::from($appointmentSlot)->make(),
            default => collect([$appointmentAvailabilitySlot])
        };
    }

    private function calculateAvailabilitySlots(AppointmentSlot $appointmentSlot, ?AppointmentAvailabilitySlot $appointmentAvailabilitySlot = null): Collection
    {
        $appointmentConfiguration = $appointmentSlot->getAppointmentConfiguration();

        return $this->withAppointmentAvailabilitySlot($appointmentSlot, $appointmentAvailabilitySlot)
            ->flatMap(function (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) use ($appointmentSlot, $appointmentConfiguration) {
                if (! $appointmentSlot->isBetween($appointmentAvailabilitySlot->getStart(), $appointmentAvailabilitySlot->getEnd())) {
                    return [$appointmentAvailabilitySlot];
                }

                $appointmentAvailabilitySlot->start = $appointmentSlot->getEnd()->addMinutes(
                    $appointmentConfiguration->nextAppointmentThresholdMinutes
                );

                return [
                    AppointmentAvailabilitySlotFactory::from(
                        $appointmentSlot->newSlotData(
                            start: $appointmentAvailabilitySlot->getStart(),
                            end: $appointmentSlot->getStart()->subMinutes(
                                $appointmentConfiguration->nextAppointmentThresholdMinutes
                            )
                        )
                    )->make(),
                    $appointmentAvailabilitySlot,
                ];
            });
    }
}
