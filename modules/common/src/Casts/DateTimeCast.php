<?php

declare(strict_types=1);

namespace AppointmentService\Common\Casts;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final class DateTimeCast implements Cast
{
    public function __construct(
        private string $format
    ) {}

    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): mixed
    {
        return Carbon::createFromFormat($this->format, $value);
    }
}
