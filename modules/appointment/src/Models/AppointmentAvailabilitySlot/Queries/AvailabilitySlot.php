<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\Queries;

use AppointmentService\Appointment\Contracts\Slot;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;

trait AvailabilitySlot
{
    public function whereAvailabilitySlot(Slot $appointmentSlot): self
    {
        return $this->where('start', '<=', $appointmentSlot->getStart())
            ->where('end', '>=', $appointmentSlot->getEnd());
    }

    public function whereAvailabilitySlots(string|array|DateTimeInterface $date, ?array $orderBy = null): self
    {
        return $this->when(
            is_array($date),
            fn (Builder $query) => $query->whereBetween('date', $date),
            fn (Builder $query) => $query->whereDate('date', now()->parse($date))
        )
            ->when($orderBy, fn (Builder $query, array $orderParams) => $query->orderBy(...$orderParams));
    }
}
