<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Repositories;

use AppointmentService\Appointment\Attributes\CurrentAccount;
use AppointmentService\Appointment\Contracts\Repositories\AppointmentConfiguration;
use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration as AppointmentConfigurationModel;
use AppointmentService\Common\Concerns\Repository;

final class AppointmentConfigurationRepository implements AppointmentConfiguration
{
    use Repository;

    public function __construct(
        #[CurrentAccount] private readonly Account $account,
        private readonly AppointmentConfigurationModel $model
    ) {}

    public function getLatestVersion(array|string $relations = []): ?AppointmentConfigurationModel
    {
        return $this->query->with($relations)
            ->whereBelongsTo($this->account)
            ->first();
    }
}
