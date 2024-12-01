<?php

namespace Core\Features\Appointment\Data;

use Core\Features\Appointment\Contracts\AppointmentSlot;
use Core\Features\Appointment\Models\Account\Account;
use Core\Features\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Collection;

final class AppointmentSlotData extends SlotData implements AppointmentSlot
{
    private readonly Account $account;

    private function __construct(
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

    public function getAccount(): Account
    {
        return $this->account;
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
