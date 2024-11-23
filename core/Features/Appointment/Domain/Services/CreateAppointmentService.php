<?php

namespace Core\Features\Appointment\Domain\Services;

use Core\Features\Appointment\Domain\Contracts\AppointmentAvailabilitySlotRepository;
use Core\Features\Appointment\Domain\Contracts\AppointmentSlot;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories\AppointmentAvailabilitySlotCollectionFactory;
use Core\Features\Appointment\Models\AppointmentAvailabilitySlot\Factories\AppointmentAvailabilitySlotFactory;
use Core\Features\Common\Data\NullableData;
use Illuminate\Support\Collection;

final class CreateAppointmentService
{
    public function __construct(
        private readonly AppointmentAvailabilitySlotRepository $appointmentAvailabilitySlotRepository
    ) {}

    public function __invoke(AppointmentSlot $appointmentSlot)
    {
        $appointmentAvailabilitySlot = $this->appointmentAvailabilitySlotRepository->getAvailabilitySlot($appointmentSlot);

        $this->calculateAvailabilitySlots($appointmentSlot, $appointmentAvailabilitySlot)
            ->each(
                fn (AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => $appointmentAvailabilitySlot->save()
            );

        // $this->eventBus->publish(new CreateAppointment($appointmentSlot));

        return NullableData::from();
    }

    private function withAppointmentAvailabilitySlot(AppointmentSlot $appointmentSlot, ?AppointmentAvailabilitySlot $appointmentAvailabilitySlot): Collection
    {
        return match ($appointmentAvailabilitySlot) {
            null => AppointmentAvailabilitySlotCollectionFactory::from($appointmentSlot)->make(),
            default => $appointmentAvailabilitySlot->toCollection(),
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