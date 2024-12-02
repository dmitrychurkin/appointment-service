<?php

namespace Core\Features\Appointment\Data;

use Core\Features\Appointment\Contracts\AppointmentSlot;
use Core\Features\Appointment\Models\Account\Account;
use Core\Features\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

final class AppointmentSlotData extends SlotData implements AppointmentSlot
{
    private readonly Account $account;

    public function __construct(
        public Carbon $start,
        public Carbon $end,
        public readonly string $title,
    ) {
        parent::__construct($start, $end);
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
