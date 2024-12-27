<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\AppointmentConfiguration;

use AppointmentService\Common\Builders\QueryBuilder;

final class AppointmentConfigurationBuilder extends QueryBuilder
{
    use AppointmentConfigurationQueries;
}
