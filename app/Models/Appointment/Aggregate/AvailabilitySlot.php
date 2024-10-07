<?php

namespace App\Models\Appointment\Aggregate;

use App\Models\Appointment\Builder\AvailabilitySlotBuilder;
use Carbon\CarbonImmutable;
use Ecotone\Modelling\Attribute\{Aggregate, IdentifierMethod};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;
use Override;

#[Aggregate]
class AvailabilitySlot extends Model
{
    use HasFactory, HasUuids, Lift;

    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $uuid;

    #[Override]
    public function newEloquentBuilder($query): AvailabilitySlotBuilder
    {
        return new AvailabilitySlotBuilder($query);
    }

    #[IdentifierMethod('uuid')]
    public function getId(): ?int
    {
        return $this->uuid;
    }

    public function from(): Attribute
    {
        return Attribute::make(
            set: fn(CarbonImmutable $value) => [
                'from' => $value,
                'duration' => $value->diffInMinutes($this->to),
            ],
        );
    }

    public function to(): Attribute
    {
        return Attribute::make(
            set: fn(CarbonImmutable $value) => [
                'to' => $value,
                'duration' => $this->from->diffInMinutes($value),
            ],
        );
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'from' => 'immutable_datetime',
            'to' => 'immutable_datetime',
        ];
    }
}
