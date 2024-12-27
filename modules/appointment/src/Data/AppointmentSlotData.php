<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Data;

use AppointmentService\Appointment\Contracts\AppointmentSlot;
use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

final class AppointmentSlotData extends SlotData implements AppointmentSlot
{
    public static function rules(): array
    {
        return [
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'title' => ['required', 'string'],
        ];
    }

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
