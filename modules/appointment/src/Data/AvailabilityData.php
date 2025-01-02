<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Concerns\WithAppointmentConfiguration;
use AppointmentService\Appointment\Concerns\WithSlot;
use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Common\Casts\DateTimeCast;
use AppointmentService\Common\Data\Data;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;

final class AvailabilityData extends Data implements Availability
{
    use WithAppointmentConfiguration, WithSlot;

    public function __construct(
        public readonly AppointmentConfiguration $appointmentConfiguration,
        public readonly int $duration,
        #[WithCast(DateTimeCast::class, 'Y-m-d')]
        public readonly ?Carbon $date = null,
        private readonly ?Carbon $start = null,
        private readonly ?Carbon $end = null
    ) {}

    public function getDate(): Carbon
    {
        return $this->date ?? now();
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
}
