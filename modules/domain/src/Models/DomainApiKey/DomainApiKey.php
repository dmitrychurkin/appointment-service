<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\DomainApiKey;

use AppointmentService\Common\Concerns\HasFactory;
use AppointmentService\Common\Concerns\HasUlids;
use AppointmentService\Common\Models\Model;

final class DomainApiKey extends Model
{
    use DomainApiKeyRelations, HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_domain_id',
        'key',
        'name',
    ];

    public function uniqueIds(): array
    {
        return ['key'];
    }
}
