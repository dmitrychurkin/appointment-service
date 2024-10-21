<?php

namespace App\Models\Data;

use App\Models\Account;
use App\Models\AppointmentConfiguration;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

abstract class AppointmentSlot extends Slot
{
    private readonly User $user;

    public function __construct(
        private readonly string $title,
        array ...$args
    ) {
        parent::__construct(...$args);
    }

    public function withUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAccount(): Account
    {
        return once(fn () => $this->user->account);
    }

    public function getAppointmentConfiguration(): AppointmentConfiguration
    {
        return once(
            fn () => $this->getAccount()
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
