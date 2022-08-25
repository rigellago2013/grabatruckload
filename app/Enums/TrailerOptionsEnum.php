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
final class TrailerOptionsEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'container_locks' => 'Container Locks',
            'container_lift' => 'Container Lift',
        ];
    }
}
