<?php

namespace App\Models\Appointment\Aggregate;

use App\Models\Common\Concerns\Uuids;
use Carbon\CarbonImmutable;
use Ecotone\Modelling\Attribute\Aggregate;
use Ecotone\Modelling\Attribute\IdentifierMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Lift;

#[Aggregate]
class Appointment extends Model
{
    use HasFactory, Lift, SoftDeletes, Uuids;

    #[Fillable]
    #[Cast('immutable_datetime')]
    public CarbonImmutable $start;

    #[Fillable]
    #[Cast('immutable_datetime')]
    public CarbonImmutable $end;

    #[Fillable]
    #[Cast('string')]
    public string $title;

    #[IdentifierMethod('uuid')]
    public function getId(): ?int
    {
        return $this->uuid;
    }
}
