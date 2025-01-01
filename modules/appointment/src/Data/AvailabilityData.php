<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Contracts\Availability;
use AppointmentService\Common\Casts\DateTimeCast;
use AppointmentService\Common\Data\Data;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\WithCast;

final class AvailabilityData extends Data implements Availability
{
    public static function rules(): array
    {
        return [
            'date' => ['sometimes', 'required', 'date', 'date_format:Y-m-d', 'after:yesterday'],
            'duration' => ['required', 'integer', 'min:1', 'max:1440'],
        ];
    }

    public function __construct(
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

    public function isBetween(Carbon $start, Carbon $end): bool
    {
        return $this->getDate()->isBetween($start, $end);
    }
}
