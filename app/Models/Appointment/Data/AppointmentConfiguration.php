<?php

namespace App\Models\Appointment\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapInputName(SnakeCaseMapper::class)]
final class AppointmentConfiguration extends Data
{
    public function __construct(
        public readonly int $appointmentsPerDay,
        public readonly int $nextAppointmentThresholdMinutes,
    ) {}
}
