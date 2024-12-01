<?php

namespace Core\Features\Appointment\Contracts;

use Core\Features\Appointment\Models\Account\Account;
use Core\Features\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use Illuminate\Database\Eloquent\Collection;

interface AppointmentSlot extends Slot, SlotMethods
{
    public function getAccount(): Account;

    public function getAppointmentConfiguration(): AppointmentConfiguration;

    public function getConfigurationAvailabilitySlots(): Collection;
}
