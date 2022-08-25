<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Models\Load;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Collection;

class GetOffersForLoad extends BaseAction
{
    /**
     * @param Load $load
     * @param ?User $offeror
     * @return Collection<Offer>
     */
    public function execute(
        Load $load,
        ?User $offeror = null
    ): Collection {
        $this->authorise();

        $query = Offer::query();

        if ($offeror) {
            $query->where('user_id', $offeror->id);
        }

        return $query->forLoad($load)
            ->latest()
            ->get();
    }
}
