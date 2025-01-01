<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Common\Casts\DateTimeCast;
use AppointmentService\Common\Data\Data;
use DateTimeInterface;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;

final class AvailabilityData extends Data implements Availability
{
    public static function rules(): array
    {
        return [
            'date' => ['required', 'date', 'after:yesterday', 'date_format:Y-m-d'],
            'duration' => ['required', 'integer', 'min:1'],
        ];
    }

    public function __construct(
        #[WithCast(DateTimeCast::class, 'Y-m-d')]
        public readonly Carbon $date,
        public readonly int $duration
    ) {}

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
}
