<?php

namespace App\Models;

use App\Builders\VehicleGroupBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VehicleGroup
 *
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VehicleGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class VehicleGroup extends Model
{
    use HasFactory;

    /**
     * @param $query
     * @return VehicleGroupBuilder<User>
     */
    public function newEloquentBuilder($query): VehicleGroupBuilder
    {
        return new VehicleGroupBuilder($query);
    }

    public function movements()
    {
        return $this->belongsToMany(Movement::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function totalVolume()
    {
        return $this->vehicles()->sum('volume_capacity');
    }

    public function totalWeight()
    {
        return $this->vehicles()->sum('weight_capacity');
    }
}
