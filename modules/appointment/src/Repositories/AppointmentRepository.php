<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Contracts\Repositories\Appointment;
use AppointmentService\Appointment\Models\Appointment\Appointment as AppointmentModel;
use AppointmentService\Common\Concerns\Repository;
use AppointmentService\Common\Contracts\TransformableData;
use DateTimeInterface;

final class AppointmentRepository implements Appointment
{
    use Repository;

    public function __construct(
        private readonly AppointmentModel $model
    ) {}

    public function createAppointment(TransformableData $appointmentSlot): AppointmentModel
    {
        ['start' => $start, 'end' => $end, 'title' => $title] = $appointmentSlot->toArray();

        return $this->model::create([
            'start' => $start,
            'end' => $end,
            'title' => $title,
            'user_id' => auth()->id(),
        ]);
    }

    public function getUserCountForDate(string|DateTimeInterface $date): int
    {
        return $this->query->whereDate('start', now()->parse($date))
            ->whereBelongsTo(auth()->user())
            ->count();
    }
}
