<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Concerns\WithAppointmentConfiguration;
use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Common\Casts\DateTimeCast;
use AppointmentService\Common\Data\Data;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;

final class AvailabilityData extends Data implements Availability
{
    use WithAppointmentConfiguration;

    public function __construct(
        public readonly AppointmentConfiguration $appointmentConfiguration,
        public readonly int $duration,
        #[WithCast(DateTimeCast::class, 'Y-m-d')]
        public readonly ?Carbon $date = null
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
