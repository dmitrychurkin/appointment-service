<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot;

use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Common\Attributes\CurrentAccount;

final class AppointmentAvailabilitySlotObserver
{
    public function __construct(
        #[CurrentAccount(castTo: Account::class)] private readonly Account $account
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
