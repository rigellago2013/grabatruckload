<?php

namespace App\Models;

use App\States\Load\LoadState;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;
use Spatie\Tags\HasTags;

/**
 * App\Models\Load
 *
 * @method static \Database\Factories\LoadFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Load newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Load newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Load query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $code Reference code visible internally and externally
 * @property LoadState $state
 * @property int|null $weight Estimated weight of the load
 * @property float|null $volume Estimated volume of the load
 * @property int|null $vehicle_id
 * @property int $user_id
 * @property string|null $pickup_start
 * @property string|null $pickup_end
 * @property string|null $pickup_location
 * @property int|null $pickup_address_id
 * @property string|null $delivery_start
 * @property string|null $delivery_end
 * @property string|null $delivery_location
 * @property int|null $delivery_address_id
 * @property string|null $expiry
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Team $team
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load comparison($geometryColumn, $geometry, $relationship)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load contains($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load crosses($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load disjoint($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load distance($geometryColumn, $geometry, $distance)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load distanceExcludingSelf($geometryColumn, $geometry, $distance)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load distanceSphere($geometryColumn, $geometry, $distance)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load distanceSphereExcludingSelf($geometryColumn, $geometry, $distance)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load distanceSphereValue($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load distanceValue($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load doesTouch($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load equals($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load intersects($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load orderByDistance($geometryColumn, $geometry, $direction = 'asc')
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load orderByDistanceSphere($geometryColumn, $geometry, $direction = 'asc')
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load orderBySpatial($geometryColumn, $geometry, $orderFunction, $direction = 'asc')
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load overlaps($geometryColumn, $geometry)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereCode($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereCreatedAt($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereDeliveryAddressId($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereDeliveryEnd($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereDeliveryLocation($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereDeliveryStart($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereExpiry($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereId($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereNotState(string $column, $states)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load wherePickupAddressId($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load wherePickupEnd($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load wherePickupLocation($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load wherePickupStart($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereState($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereTeamId($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereUpdatedAt($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereVehicleId($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereVolume($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereWeight($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load within($geometryColumn, $polygon)
 * @property string|null $customer_max_currency_code
 * @property int|null $customer_max_amount
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereCustomerMaxAmount($value)
 * @method static \Grimzy\LaravelMysqlSpatial\Eloquent\Builder|Load whereCustomerMaxCurrencyCode($value)
 */
class Load extends Model implements HasMedia
{
    use HasFactory;
    use HasStates;
    use HasTags;
    use LogsActivity;
    use InteractsWithMedia;
    use SpatialTrait;

    protected $table = 'loads';

    protected $primaryKey = 'id';

    protected $casts = [
        'state' => LoadState::class,
        'delivery_equipment' => 'array',
        'pickup_equipment' => 'array',
        'extra_emails' => 'array',
    ];

    protected $dates = [
        'pickup_start',
        'pickup_end',
        'delivery_start',
        'delivery_end',
        'expiry',
    ];

    protected $spatialFields = [
        'delivery_location',
        'pickup_location',
    ];

    protected $fillables = [
        'state',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->dontSubmitEmptyLogs();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pickupAddress()
    {
        return $this->belongsTo(Address::class, 'pickup_address_id', 'id');
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(Address::class, 'delivery_address_id', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
