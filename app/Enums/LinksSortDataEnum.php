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
final class LinksSortDataEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'pickup_start' => 'Pickup Date',
            'weight' => 'Cubic/Weight',
            'volume' => 'Volume',
            'customer_max_amount' => 'Asking Price',
            'expiry' => 'Listing Expiry',
            'destination_end' => 'Delivery Deadline',
            'pickup_address_id' => 'Pickup',
            'destination_address_id' => 'Destination',
            'code' => 'Load Code',
            'state' => 'State',
        ];
    }
}
