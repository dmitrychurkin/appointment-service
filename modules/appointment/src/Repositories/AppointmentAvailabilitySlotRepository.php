<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Attributes\CurrentAccount;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Contracts\Slot;
use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot as AppointmentAvailabilitySlotModel;
use AppointmentService\Common\Concerns\Repository;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

final class AppointmentAvailabilitySlotRepository implements AppointmentAvailabilitySlot
{
    use Repository;

    private Builder $accountQuery {
        get => $this->query->whereBelongsTo($this->account);
    }

    public function __construct(
        private readonly AppointmentAvailabilitySlotModel $model,
        #[CurrentAccount] private readonly Account $account,
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
