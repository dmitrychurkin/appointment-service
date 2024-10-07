<?php

namespace App\Models\Appointment\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Validation\ArrayType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

abstract class AppointmentSlot extends Data
{
    #[ArrayType]
    public AppointmentConfiguration|Optional $configuration;

    public function __construct(
        public readonly Carbon $start,
        public readonly Carbon $end
    ) {
        $this->withConfiguration();
    }

    public function withConfiguration(?AppointmentConfiguration $configuration = null): static
    {
        $this->configuration = $configuration ?? AppointmentConfiguration::from(config('appointment'));

        return $this;
    }
}
