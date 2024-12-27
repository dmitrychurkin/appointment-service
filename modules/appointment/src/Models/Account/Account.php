<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\Account;

use AppointmentService\Common\Models\Account as BaseAccount;

final class Account extends BaseAccount
{
    use AccountRelations;
}
