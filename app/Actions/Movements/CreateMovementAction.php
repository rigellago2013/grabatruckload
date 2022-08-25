<?php

namespace App\Actions\Movements;

use App\Data\Movements\BasicData;
use App\Models\Movement;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class CreateMovementAction
{
    public function execute(BasicData $data): Movement
    {
        return Movement::create([
            'pickup' => new Point(0, 0),
            'pickup_start' => $data->pickupStart->format('Y-m-d h:m:s'),
            'pickup_end' => $data->pickupEnd->format('Y-m-d h:m:s'),
            'destination' => new Point(0, 0),
            'destination_start' => $data->destinationStart->format('Y-m-d h:m:s'),
            'destination_end' => $data->destinationEnd->format('Y-m-d h:m:s'),
            'pickup_address_id' => $data->pickupAddress,
            'destination_address_id' => $data->destinationAddress,
            //'path' => "",
        ]);
    }
}
