<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;
use AppointmentService\Common\Attributes\CurrentAccount;
use AppointmentService\Common\Concerns\Repository;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

final class AppointmentAvailabilitySlotRepository implements AppointmentAvailabilitySlot
{
    use Repository;

    private Builder $accountQuery {
        get {
        return $this->query->whereBelongsTo($this->account);
    }
    }

    public function __construct(
        private readonly AppointmentAvailabilitySlotModel $model,
        #[CurrentAccount(castTo: Account::class)] private readonly Account $account,
    ) {}

    public function exists(string|DateTimeInterface $date): bool
    {
        return $this->accountQuery->whereDate('date', now()->parse($date))
            ->exists();
    }

    public function getAvailabilitySlot(Slot $appointmentSlot): ?AppointmentAvailabilitySlotModel
    {
        return $this->accountQuery->whereAvailabilitySlot($appointmentSlot)
            ->first();
    }

    public function getAvailabilitySlots(string|array|DateTimeInterface $date, ?array $orderBy = null): Collection
    {
        return $this->accountQuery->whereAvailabilitySlots($date, $orderBy)
            ->get();
    }
}
