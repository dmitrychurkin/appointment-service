<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Attributes\CurrentAccount;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentConfiguration;
use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration as AppointmentConfigurationModel;

final class AppointmentConfigurationRepository implements AppointmentConfiguration
{
    public function __construct(
        #[CurrentAccount] private readonly Account $account
    ) {}

    public function getLatestVersion(array|string $relations = []): ?AppointmentConfigurationModel
    {
        return $this->account
            ->appointmentConfigurations()
            ->with($relations)
            ->latestVersion()
            ->first();
    }
}
