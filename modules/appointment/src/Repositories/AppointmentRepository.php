<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Attributes\CurrentUser;
use AppointmentService\Appointment\Contracts\Repositories\Appointment;
use AppointmentService\Appointment\Models\Appointment\Appointment as AppointmentModel;
use AppointmentService\Appointment\Models\User\User;
use AppointmentService\Common\Contracts\TransformableData;
use DateTimeInterface;

final class AppointmentRepository implements Appointment
{
    public function __construct(
        #[CurrentUser] private readonly User $user
    ) {}

    public function createAppointment(TransformableData $appointmentSlot): void
    {
        ['start' => $start, 'end' => $end, 'title' => $title] = $appointmentSlot->toArray();

        AppointmentModel::create([
            'start' => $start,
            'end' => $end,
            'title' => $title,
            'user_id' => $this->user->id,
        ]);
    }

    public function getUserCountForDate(string|DateTimeInterface $date): int
    {
        return AppointmentModel::whereDate('start', now()->parse($date))
            ->whereBelongsTo($this->user)
            ->count();
    }
}
