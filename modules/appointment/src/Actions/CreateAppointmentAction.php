<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Actions;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotRepository;
use AppointmentService\Appointment\Events\AvailabilitySlotsCreated;
use AppointmentService\Appointment\Factories\AppointmentAvailabilitySlotCollectionFactory;
use AppointmentService\Appointment\Factories\AppointmentAvailabilitySlotFactory;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use Illuminate\Support\Collection;

final class CreateAppointmentAction
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

        AvailabilitySlotsCreated::dispatch($appointmentSlot);
    }

    private function calculateAvailabilitySlots(AppointmentSlot $appointmentSlot, ?AppointmentAvailabilitySlot $appointmentAvailabilitySlot = null): Collection
    {
        $appointmentConfiguration = $appointmentSlot->getAppointmentConfiguration();

        return $this->fromAppointmentAvailabilitySlots($appointmentSlot, $appointmentAvailabilitySlot)
            ->reduce(fn (Collection $appointmentAvailabilitySlots, AppointmentAvailabilitySlot $appointmentAvailabilitySlot) => (
                $appointmentSlot->isBetween($appointmentAvailabilitySlot->getStart(), $appointmentAvailabilitySlot->getEnd())
                ? $appointmentAvailabilitySlots->push(
                    AppointmentAvailabilitySlotFactory::from(
                        $appointmentSlot->newSlotData(
                            start: $appointmentAvailabilitySlot->getStart(),
                            end: $appointmentSlot->getStart()
                        )
                    )->make(),
                    AppointmentAvailabilitySlotFactory::from(
                        $appointmentSlot->newSlotData(
                            start: $appointmentSlot->getEnd()->addMinutes(
                                $appointmentConfiguration->next_appointment_threshold_minutes
                            ),
                            end: $appointmentAvailabilitySlot->getEnd()
                        )
                    )->make(),
                )
                : $appointmentAvailabilitySlots->push($appointmentAvailabilitySlot)
            ), collect());
    }

    private function fromAppointmentAvailabilitySlots(AppointmentSlot $appointmentSlot, ?AppointmentAvailabilitySlot $appointmentAvailabilitySlot): Collection
    {
        return match ($appointmentAvailabilitySlot) {
            null => AppointmentAvailabilitySlotCollectionFactory::from($appointmentSlot)->make(),
            default => $appointmentAvailabilitySlot->toCollection(),
        };
    }
}
