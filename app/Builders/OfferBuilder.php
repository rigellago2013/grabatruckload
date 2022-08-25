<?php

namespace App\Builders;

use App\Models\Load;
use Illuminate\Database\Eloquent\Builder;

/**
 * @template TModelClass
 * @extends Builder<TModelClass>
 */
class OfferBuilder extends Builder
{
    public function forLoad(Load $load)
    {
        return $this->where('load_id', $load->id);
    }
}
