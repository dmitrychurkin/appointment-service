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

    public function whereAvailabilitySlots(string|array|DateTimeInterface $date, ?array $order = null): self
    {
        return $this->when(
            is_array($date),
            fn (Builder $query, array $dates) => $query->whereBetween('date', $dates),
            fn (Builder $query, string|DateTimeInterface $date) => $query->whereDate('date', now()->parse($date))
        )
            ->when($order, fn (Builder $query, array $order) => $query->orderBy(...$order));
    }
}
