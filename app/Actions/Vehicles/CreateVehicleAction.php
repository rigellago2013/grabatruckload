<?php

namespace App\Actions\Vehicles;

use App\Data\Vehicles\BasicData;
use App\Models\Vehicle;

class CreateVehicleAction
{
    public function execute(BasicData $data): Vehicle
    {
        $orCrCopy = [];
        $truckImgs = [];
        $vehicle = Vehicle::create([
            'type' => $data->loadType,
            'category' => $data->category,
            'plate_number' => $data->plateNumber,
            'notes' => $data->notes,
            'deck_length' => $data->deckLength,
            // 'or' => $data->or,
            // 'cr' => $data->cr,
            'truck_picture' => json_encode($truckImgs),
            'trailer_type' => $data->trailerType,
            // 'trailer_options' => $data->trailerOption,
            // 'volume' => $data->volume,
            'maximum_capacity' => $data->weight,
            'truck_type' => $data->truckType,
            'truck_category' => $data->truckCategory,
            'or_cr_copy' => json_encode($orCrCopy),
            'vehicle_group_id' => 0,
        ]);

        // Handle images
        foreach ((array) $data->truckPicture as $image) {
            // $truckImgUrl = $image->store('public/truckPictures');
            // array_push($truckImgs, $truckImgUrl);
            // $vehicle->addMedia($image)->toMediaCollection();
            $vehicle->addMedia($image->getRealPath())
                ->usingName($image->getClientOriginalName())
                ->toMediaCollection('truckPictures');
        }

        // // Handle files
        // foreach ((array) $data->or as $or) {
        //     // $orUrl = $or->store('public/or');
        //     // array_push($orCrCopy, $orUrl);
        //     $vehicle->addMedia($or)->toMediaCollection('orPictures');
        // }

        // // Handle files
        // foreach ((array) $data->cr as $cr) {
        //     // $crUrl = $cr->store('public/cr');
        //     // array_push($orCrCopy, $crUrl);
        //     $vehicle->addMedia($cr)->toMediaCollection('crPictures');
        // }

        return $vehicle;
    }
}
