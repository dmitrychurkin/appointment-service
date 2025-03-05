<?php

declare(strict_types=1);

namespace AppointmentService\Common\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait Repository
{
    private Builder $query {
        get {
        return $this->query ?? $this->model::query();
    }
    set {
        $this->query = $value;
    }
    }

    public function withQuery(Builder $query): self
    {
        $this->query = $query;

        return $this;
    }
}
