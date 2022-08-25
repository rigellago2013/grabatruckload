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
final class VehicleSortDataEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'plate_number' => 'Plate Number',
            'type' => 'Type',
            'category' => 'Category',
            'deck_length' => 'Deck Length',
            'maximum_capacity' => 'Maximum Capacity',

        ];
    }
}
