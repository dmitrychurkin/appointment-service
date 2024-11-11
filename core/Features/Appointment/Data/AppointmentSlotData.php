<?php

namespace Core\Features\Appointment\Data;

use Core\Features\Appointment\Models\Account\Account;
use Core\Features\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Collection;

class AppointmentSlotData extends SlotData
{
    private readonly Account $account;

    public function __construct(
        private readonly string $title,
        array ...$args
    ) {
        parent::__construct(...$args);
    }

    public function withAccount(Account $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getAppointmentConfiguration(): AppointmentConfiguration
    {
        return once(
            fn () => $this->account
                ->appointmentConfigurations()
                ->latestVersion()
                ->firstOrFail()
        );
    }

    public function getConfigurationAvailabilitySlots(): Collection
    {
        return once(
            fn () => $this->getAppointmentConfiguration()
                ->configurationAvailabilitySlots
        );
    }
}
