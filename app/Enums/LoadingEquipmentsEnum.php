<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self loose()
 * @method static self refrigerated()
 * @method static self heavy()
 * @method static self dangerous()
 * @method static self general()
 * @method static self livestock()
 * @method static self container()
 * @method static self vehicle()
 */
final class LoadingEquipmentsEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'forklifts' => 'Forklifts',
            'boomtruck' => 'Boom Truck',
            'tractor' => 'Tractor',
            'taillift' => 'Tail Lift',
            'ramps' => 'Ramps',
            'dumptruck' => 'Dump Truck',
        ];
    }
}
