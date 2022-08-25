<?php

namespace App\Actions\Loads;

use App\Actions\BaseAction;
use App\Exceptions\InvalidStateException;
use App\Models\Load;
use App\Models\Movement;
use App\States\Load\Published;

class CreateLoadMatches extends BaseAction
{
    /**
     * @param Load $load
     * @param bool $notify send notifications of the matches to the matched owners
     * @see https://linear.app/grabatruckloadph/issue/GRA-32/matches-and-matching-logic
     */
    public function execute(Load $load, bool $notify = true)
    {
        $this->authorise();

        // Load has to be in `published` state
        if ($load->state->getValue() !== Published::$name) {
            throw new InvalidStateException('Load is not in `published` state');
        }

        $query = Movement::query();

        // Find all movements where the movement destination is withing 50km of the pickup point
        // of the load we're matching
        $query->distanceExcludingSelf('destination', $load->pickup_location, 50000);

        // We match loads where pickup window
        // - contains the delivery time
        // - the pickup window starts after the delivery time
        // - for one week after
        $query->where(function ($builder) use ($load): void {
            $builder->where(function ($query) use ($load): void {
                $query->where('pickup_start', '>=', $load->pickup_start->subWeek())
                    ->where('pickup_start', '<=', $load->pickup_end);
            })
                ->orWhere(function ($query) use ($load): void {
                    $query->where('destination_end', '>=', $load->pickup_start->subWeek())
                        ->where('destination_end', '<=', $load->pickup_end);
                });
        });

        // Match on volume/weight... this is matching a movement that has been entered by the owner (ie a single
        // section of a route) against the loads that are available (in Published state).
        //        $query->whereHas('vehicleGroups', function(Builder $builder) {
        //
        //        });

        return $query->with('vehicleGroups')->get();
    }
}
