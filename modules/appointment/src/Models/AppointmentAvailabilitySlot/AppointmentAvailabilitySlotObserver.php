<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot;

use AppointmentService\Appointment\Attributes\CurrentAccount;
use AppointmentService\Appointment\Models\Account\Account;

final class AppointmentAvailabilitySlotObserver
{
    public function __construct(
        #[CurrentAccount] private readonly Account $account
    ) {}

    /**
     * Handle the AppointmentAvailabilitySlot "saving" event.
     */
    public function saving(AppointmentAvailabilitySlot $appointmentAvailabilitySlot): void
    {
        $appointmentAvailabilitySlot->syncDuration();
        $appointmentAvailabilitySlot->account()->associate($this->account);
    }

    /**
     * Handle the AppointmentAvailabilitySlot "created / updated" event.
     */
    public function saved(AppointmentAvailabilitySlot $appointmentAvailabilitySlot): void
    {
        $appointmentAvailabilitySlot->deleteInvalid();
    }
}
