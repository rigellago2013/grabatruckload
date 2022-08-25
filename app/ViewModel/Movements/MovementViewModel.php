<?php

namespace App\ViewModel\Movements;

use App\Models\Movement;
use Spatie\ViewModels\ViewModel;

class MovementViewModel extends ViewModel
{
    public $movement;
    public $pickupAddress;
    public $destinationAddress;
    public $pickupLat;
    public $pickupLng;
    public $destinationLat;
    public $destinationLng;
    public $centerPoint = [];
    public $pickupPoint = [];
    public $destinationPoint = [];
    public $markers = [];

    public function __construct($id)
    {
        $this->movement = Movement::where('id', $id)->first();
        $this->pickupLat = $this->movement->pickup->getLat();
        $this->pickupLng = $this->movement->pickup->getLng();
        $this->destinationLat = $this->movement->destination->getLat();
        $this->destinationLng = $this->movement->destination->getLng();
        $this->centerPoint = ['lat' => $this->pickupLat, 'long' => $this->pickupLng];
        $this->pickupPoint = ['lat' => $this->pickupLat, 'long' => $this->pickupLng, 'title' => 'Your Title'];
        $this->destinationPoint = ['lat' => $this->destinationLat, 'long' => $this->destinationLng, 'title' => 'Your Title'];
        $this->markers = [$this->pickupPoint, $this->destinationPoint];
    }
}
