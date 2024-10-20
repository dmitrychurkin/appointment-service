<?php

namespace App\Models;

use App\Models\Concern\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasMany;
use WendellAdriel\Lift\Lift;

#[HasMany(AppointmentConfiguration::class)]
class Account extends Model
{
    use HasFactory, Lift, SoftDeletes, Uuids;

    #[PrimaryKey]
    public int $id;

    public string $uuid;

    #[Fillable]
    public string $name;

    #[Fillable]
    public string $slug;
}
