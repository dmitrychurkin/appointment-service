<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Contracts;

use AppointmentService\Appointment\Models\AppointmentAvailabilitySlot\AppointmentAvailabilitySlot;
use AppointmentService\Appointment\Models\AppointmentConfiguration\AppointmentConfiguration;
use AppointmentService\Common\Contracts\TransformableData;

interface AppointmentSlot extends Slot, SlotConfiguration, SlotMethods, TransformableData
{
    public function getAppointmentAvailabilitySlot(): ?AppointmentAvailabilitySlot;

    public function getAppointmentConfiguration(): AppointmentConfiguration;
}
