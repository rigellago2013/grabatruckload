<?php

namespace App\Actions\Links;

use App\Actions\BaseAction;
use App\Data\Links\SearchLinkData;
use App\Enums\StateEnum;
use App\Models\Link;

class SearchLink extends BaseAction
{
    public function execute(SearchLinkData $data)
    {
        $pickup_date = $data->dateStart;
        $delivery_date = $data->dateEnd;
        $pickupRegion = $data->pickupRegion;
        $deliveryRegion = $data->deliveryRegion;
        $searchTerm = $data->searchTerm;
        $loadType = $data->loadType;
        $sort = $data->sort;

        return Link::query()->when($searchTerm, function ($query, $searchTerm): void {
            $query->whereHas('loadMatch', function ($query) use ($searchTerm) {
                return $query->where('code', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('deliveryAddress', function ($query) use ($searchTerm) {
                        return $query->where('province', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('street_address', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('barangay', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('city', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('province', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('postcode', 'LIKE', "%{$searchTerm}%");
                    })->orWhereHas('pickupAddress', function ($query) use ($searchTerm) {
                        return $query->where('province', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('street_address', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('barangay', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('city', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('province', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('postcode', 'LIKE', "%{$searchTerm}%");
                    });
            })->orWhereHas('movement', function ($query) use ($searchTerm) {
                return $query->whereHas('pickupAddress', function ($query) use ($searchTerm) {
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
            });
        })->when($pickup_date !== null && $delivery_date !== null, function ($query) use ($pickup_date, $delivery_date): void {
            $query->whereHas('loadMatch', function ($query) use ($pickup_date, $delivery_date) {
                return $query->where('pickup_start', '>=', $pickup_date)->where('delivery_end', '<=', $delivery_date);
            })->orWhereHas('movement', function ($query) use ($pickup_date, $delivery_date) {
                return $query->where('pickup_start', '>=', $pickup_date)->where('destination_end', '<=', $delivery_date);
            });
        })->when($pickupRegion, function ($query) use ($pickupRegion): void {
            $query->whereHas('loadMatch', function ($query) use ($pickupRegion) {
                return $query->whereHas('pickupAddress', function ($query) use ($pickupRegion) {
                    return $query->whereIn('province', $pickupRegion);
                });
            })->orWhereHas('movement', function ($query) use ($pickupRegion) {
                return $query->whereHas('destinationAddress', function ($query) use ($pickupRegion) {
                    return $query->whereIn('province', $pickupRegion);
                });
            });
        })->when($deliveryRegion, function ($query) use ($deliveryRegion): void {
            $query->whereHas('loadMatch', function ($query) use ($deliveryRegion) {
                return $query->whereHas('pickupAddress', function ($query) use ($deliveryRegion) {
                    return $query->whereIn('province', $deliveryRegion);
                });
            })->orWhereHas('movement', function ($query) use ($deliveryRegion) {
                return $query->whereHas('destinationAddress', function ($query) use ($deliveryRegion) {
                    return $query->whereIn('province', $deliveryRegion);
                });
            });
        })->when($loadType, function ($query): void {
            $query->whereHas('loadMatch', function ($query) {
                return $query->where('state', StateEnum::labels()['published']);
            });
        })->whereHas('loadMatch', function ($query) {
            return $query->where('state', StateEnum::labels()['published']);
        })->when($sort, function ($query, $sort): void {
            if ($sort == 'destination_end' || $sort == 'destination_address_id') {
                $query->join('movements', 'links.movement_id', '=', 'movements.id')->orderBy('movements.' . $sort);
            } else {
                $query->join('loads', 'links.load_id', '=', 'loads.id')->orderBy('loads.' . $sort);
            }
        })->paginate(25);
    }
}
