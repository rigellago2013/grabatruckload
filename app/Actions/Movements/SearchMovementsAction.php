<?php

namespace App\Actions\Movements;

use App\Data\Movements\SearchMovementData;
use App\Models\Movement;

class SearchMovementsAction
{
    public function execute(SearchMovementData $data)
    {
        $destinationEnd = $data->destinationEnd;
        $pickupStart = $data->pickupStart;
        $searchTerm = $data->searchTerm;
        $sort = $data->sort;
        $pickup = $data->pickup;
        $destination = $data->destination;

        $relationships = ['pickupAddress', 'destinationAddress'];

        return Movement::query()
            ->when($searchTerm, function ($query, $searchTerm): void {
                $query->whereHas('pickupAddress', function ($query) use ($searchTerm) {
                    return $query->where('province', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('street_address', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('barangay', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('city', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('province', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('postcode', 'LIKE', "%{$searchTerm}%");
                })->orWhereHas('destinationAddress', function ($query) use ($searchTerm) {
                    return $query->where('province', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('street_address', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('barangay', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('city', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('province', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('postcode', 'LIKE', "%{$searchTerm}%");
                });
            })
            ->when(! empty($pickupStart) && ! empty($destinationEnd), function ($query) use ($pickupStart, $destinationEnd): void {
                $query->where('pickup_start', '>=', $pickupStart)->where('destination_end', '<=', $destinationEnd);
            })
            ->when($sort, function ($query, $sort): void {
                $query->orderBy($sort, 'desc');
            })
            ->when($pickup, function ($query) use ($pickup): void {
                $query->whereHas('pickupAddress', function ($query) use ($pickup) {
                    return $query->whereIn('province', $pickup);
                });
            })
            ->when($destination, function ($query) use ($destination): void {
                $query->whereHas('pickupAddress', function ($query) use ($destination) {
                    return $query->whereIn('province', $destination);
                });
            })
            ->with($relationships)
            ->paginate(25);
    }
}
