<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\AccountDomain;

use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUuids;
use AppointmentService\Common\Models\Model;
use Override;

final class AccountDomain extends Model
{
    use AccountDomainRelations, HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_id',
        'domain',
        'uuid',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    #[Override]
    public function newEloquentBuilder($query): AccountDomainBuilder
    {
        return new AccountDomainBuilder($query);
    }
}
