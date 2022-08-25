<?php

namespace App\ViewModel\Vehicles;

use App\Models\Vehicle;
use Spatie\ViewModels\ViewModel;

class VehicleViewModel extends ViewModel
{
    public $vehicle;

    public function __construct($id)
    {
        $this->vehicle = Vehicle::where('id', $id)->first();
    }
}
