<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

final class AppointmentSlotData extends SlotData implements AppointmentSlot
{
    private readonly Account $account;

    public function __construct(
        public Carbon $start,
        public Carbon $end,
        public readonly string $title,
        public readonly ?AppointmentAvailabilitySlot $appointmentAvailabilitySlot = null
    ) {
        parent::__construct($start, $end);
    }

    public function withAccount(Account $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getAppointmentAvailabilitySlot(): ?AppointmentAvailabilitySlot
    {
        return $this->appointmentAvailabilitySlot;
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
