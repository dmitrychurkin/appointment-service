<?php

namespace App\Models\Appointment\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\{Data, Optional};

abstract class AppointmentSlot extends Data
{
    #[ArrayType]
    public AppointmentConfiguration | Optional $configuration;

    public function __construct(
        public readonly Carbon $start,
        public readonly Carbon $end
    ) {
        $this->configuration = AppointmentConfiguration::from(config('appointment'));
    }

    public function withConfiguration(?AppointmentConfiguration $configuration = null): AppointmentConfiguration
    {
        return $configuration ?? $this->configuration;
    }
}
