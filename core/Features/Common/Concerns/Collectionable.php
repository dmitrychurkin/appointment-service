<?php

namespace Core\Features\Common\Concerns;

use Illuminate\Support\Collection;

trait Collectionable
{
    public function toCollection(): Collection
    {
        return collect([$this]);
    }
}
