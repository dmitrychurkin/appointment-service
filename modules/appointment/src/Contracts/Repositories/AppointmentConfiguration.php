<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts\Repositories;

use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration as AppointmentConfigurationModel;

interface AppointmentConfiguration
{
    public function getLatestVersion(array|string $relations = []): ?AppointmentConfigurationModel;
}
