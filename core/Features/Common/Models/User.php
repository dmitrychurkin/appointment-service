<?php

namespace Core\Features\Common\Models;

use App\Models\User as UserModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class User extends UserModel
{
    /**
     * Get the account that owns the user.
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
