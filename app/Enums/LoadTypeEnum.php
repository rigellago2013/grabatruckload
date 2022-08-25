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
final class LoadTypeEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'loose' => 'Loose Bulk (Requires Tipping)',
            'refrigerated' => 'Refrigerated',
            'livestock' => 'Livestock',
            'container' => 'Container',
            'vehicle' => 'Vehicle',
            'general' => 'General Freight',
            'dangerous' => 'Dangerous Goods',
            'heavy' => 'Machinery/Heavy Haulage',
        ];
    }
}
