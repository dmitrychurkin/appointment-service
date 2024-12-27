<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use AppointmentService\Appointment\Models\Account\Account;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Collection;

interface AppointmentSlot extends Slot, SlotMethods
{
    public function getAccount(): Account;

    public function getAppointmentConfiguration(): AppointmentConfiguration;

    public function getConfigurationAvailabilitySlots(): Collection;
}
