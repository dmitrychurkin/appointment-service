<?php

namespace Core\Features\Appointment\Models\User;

use Core\Features\Appointment\Models\User\Relations\AccountBelongsTo;

trait UserRelations
{
    use AccountBelongsTo;
}
