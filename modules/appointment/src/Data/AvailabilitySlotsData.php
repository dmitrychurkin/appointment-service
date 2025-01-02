<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Concerns\WithAppointmentConfiguration;
use AppointmentService\Appointment\Concerns\WithDuration;
use AppointmentService\Appointment\Contracts\AvailabilitySlots;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Common\Casts\DateTimeCast;
use AppointmentService\Common\Data\Data;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;

final class AvailabilitySlotsData extends Data implements AvailabilitySlots
{
    use WithAppointmentConfiguration, WithDuration;

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
}
