<?php

namespace App\Actions\Loads;

use App\Data\Loads\SearchLoadData;
use App\Models\Load;

class SearchLoad
{
    public function execute(SearchLoadData $data)
    {
        $pickup_date = $data->dateStart;
        $delivery_date = $data->dateEnd;
        $pickupRegion = $data->pickupRegion;
        $deliveryRegion = $data->deliveryRegion;
        $searchTerm = $data->searchTerm;
        $loadType = $data->loadType;
        $statuses = $data->statuses;
        $sort = $data->sort;
        $relationships = ['pickupAddress', 'deliveryAddress'];

        return Load::query()->when($searchTerm, function ($query, $searchTerm): void {
            $query->where('code', 'LIKE', "%{$searchTerm}%");
        })
            ->when(! empty($pickup_date) && ! empty($delivery_date), function ($query) use ($pickup_date, $delivery_date): void {
                $query->where('pickup_start', '>=', $pickup_date)->where('delivery_end', '<=', $delivery_date);
            })
            ->when($loadType, function ($query, $loadType): void {
                $query->where('load_type', $loadType);
            })
            ->when($pickupRegion, function ($query) use ($pickupRegion): void {
                $query->whereHas('pickupAddress', function ($query) use ($pickupRegion) {
                    return $query->whereIn('province', $pickupRegion);
                });
            })
            ->when($deliveryRegion, function ($query) use ($deliveryRegion): void {
                $query->whereHas('pickupAddress', function ($query) use ($deliveryRegion) {
                    return $query->whereIn('province', $deliveryRegion);
                });
            })
            ->when($statuses, function ($query, $statuses): void {
                $query->whereIn('state', array_values($statuses));
            })
            ->when($sort, function ($query, $sort): void {
                $query->orderBy($sort, 'desc');
            })
            ->with($relationships)
            ->paginate(25);
    }
}
