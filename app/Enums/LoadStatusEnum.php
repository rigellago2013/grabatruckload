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
final class LoadStatusEnum extends Enum
{
    public static function labels(): array
    {
        return [
            'accepted' => 'Accepted',
            'cancelled' => 'Cancelled',
            'expired' => 'Expired',
            'in_transit' => 'In Transit',
            'pending_payment' => 'Pending Payment',
            'published' => 'Published',
            'draft' => 'Draft',
            'pending' => 'Pending',
            'complete' => 'Complete',
            'negotiating' => 'Negotiating',
            'problem' => 'Problem',
        ];
    }
}
