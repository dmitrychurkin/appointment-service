<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\AccountDomain;

use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUuids;
use AppointmentService\Common\Models\Model;

final class AccountDomain extends Model
{
    use AccountDomainRelations, HasFactory, HasUuids;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['domainApiKey'];

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
}
