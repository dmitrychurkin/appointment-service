<?php

namespace App\Models\Data;

use App\Models\Account;
use App\Models\AppointmentConfiguration;
use App\Models\Concern\Slot;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Data;

abstract class AppointmentSlot extends Data
{
    use Slot;

    private readonly User $user;

    public function __construct(
        private readonly Carbon $start,
        private readonly Carbon $end,
        private readonly string $title,
    ) {}

    public function withUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function isBetween(Carbon $start, Carbon $end): bool
    {
        return
            $this->start->isBetween($start, $end) &&
            $this->end->isBetween($start, $end);
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
