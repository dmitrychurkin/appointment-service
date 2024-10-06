<?php

namespace App\Models\Appointment\Aggregate;

use App\Models\Appointment\Builder\AvailabilitySlotBuilder;
use Ecotone\Modelling\Attribute\Aggregate;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\{Cast, Fillable, PrimaryKey};
use WendellAdriel\Lift\Lift;
use Override;

#[Aggregate]
class AvailabilitySlot extends Model
{
    use HasFactory, HasUuids, Lift;

    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $uuid;

    #[Fillable]
    #[Cast('immutable_datetime')]
    public string $from;

    #[Fillable]
    #[Cast('immutable_datetime')]
    public string $to;

    #[Fillable]
    #[Cast('int')]
    public int $duration;

    #[Override]
    public function newEloquentBuilder($query): AvailabilitySlotBuilder
    {
        return new AvailabilitySlotBuilder($query);
    }
}
