<?php

namespace App\Models;

use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    use SpatialTrait;

    protected $spatialFields = [

    ];

    public function loadMatch()
    {
        return $this->belongsTo(Load::class, 'load_id');
    }

    public function movement()
    {
        return $this->belongsTo(Movement::class, 'movement_id');
    }
}
