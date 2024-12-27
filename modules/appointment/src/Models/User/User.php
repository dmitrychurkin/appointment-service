<?php

declare(strict_types=1);

namespace AppointmentService\Appointment\Models\User;

use AppointmentService\Common\Models\User as UserModel;

final class User extends UserModel
{
    use UserRelations;
}
