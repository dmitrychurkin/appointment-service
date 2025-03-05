<?php

declare(strict_types=1);

namespace AppointmentService\Domain\Models\AccountDomain\Queries;

use Illuminate\Database\Eloquent\Builder;

trait WithDomainApiKeys
{
    public function withDomainApiKeys(?string $key): self
    {
        return $this->with(['domainApiKeys', fn (Builder $query) => (
            $query->when(
                $key,
                fn (Builder $query, string $key) => $query->where('key', $key),
            )
                ->latest()
                ->take(1)
        )]);
    }
}
