<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Contracts\Repositories\Appointment;
use AppointmentService\Appointment\Models\Appointment\Appointment as AppointmentModel;
use AppointmentService\Common\Contracts\TransformableData;
use DateTimeInterface;

final class AppointmentRepository implements Appointment
{
    public function createAppointment(TransformableData $appointmentSlot): void
    {
        ['start' => $start, 'end' => $end, 'title' => $title] = $appointmentSlot->toArray();

        AppointmentModel::create([
            'start' => $start,
            'end' => $end,
            'title' => $title,
            'user_id' => auth()->id(),
        ]);
    }

    public function getUserCountForDate(string|DateTimeInterface $date): int
    {
        return AppointmentModel::whereDate('start', now()->parse($date))
            ->whereBelongsTo($this->user)
            ->count();
    }
}
