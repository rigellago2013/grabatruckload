<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $spatialFields = [
        'pickup',
        'destination',
        'path',
    ];

    protected $dates = [
        'pickup_start',
        'pickup_end',
        'destination_start',
        'destination_end',
        'expiry',
    ];

    public function vehicleGroups()
    {
        return $this->belongsToMany(VehicleGroup::class);
    }

    public function pickupAddress()
    {
        return $this->belongsTo(Address::class, 'pickup_address_id');
    }

    public function destinationAddress()
    {
        return $this->belongsTo(Address::class, 'destination_address_id');
    }
}
