<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration;

use Illuminate\Database\Eloquent\Builder;

final class AppointmentConfigurationBuilder extends Builder
{
    use AppointmentConfigurationQueries;
}
