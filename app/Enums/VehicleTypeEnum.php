<?php

namespace App\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self wing()
 */
final class VehicleTypeEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'wing' => 'Wing Van',
            'truck' => 'Truck',
            'tractor' => 'Tractor',
            'van' => 'Van',
            'trailer' => 'Trailer',
        ];
    }
}
