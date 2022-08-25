<?php

namespace App\ViewModel\Loads;

use App\Models\Load;
use Spatie\ViewModels\ViewModel;

class LoadViewModel extends ViewModel
{
    public $load;
    public $deliveryAddress;
    public $pickupAddress;
    public $pickupLat;
    public $pickupLng;
    public $deliveryLat;
    public $deliveryLng;
    public $centerPoint = [];
    public $pickupPoint = [];
    public $deliveryPoint = [];
    public $markers = [];
    public $pickupEquipments;
    public $deliveryEquipments;

    public function __construct(Load $load)
    {
        $this->load = $load;
        $this->deliveryAddress = $load->deliveryAddress;
        $this->pickupAddress = $load->pickupAddress;
        $this->pickupLat = $load->pickup_location->getLat();
        $this->pickupLng = $load->pickup_location->getLng();
        $this->deliveryLat = $load->delivery_location->getLat();
        $this->deliveryLng = $load->delivery_location->getLng();
        $this->centerPoint = ['lat' => $this->pickupLat, 'long' => $this->pickupLng];
        $this->pickupPoint = ['lat' => $this->pickupLat, 'long' => $this->pickupLng, 'title' => 'Your Title'];
        $this->deliveryPoint = ['lat' => $this->deliveryLat, 'long' => $this->deliveryLng, 'title' => 'Your Title'];
        $this->markers = [$this->pickupPoint, $this->deliveryPoint];
        $this->pickupEquipments = implode(', ', json_decode($load->pickup_equipments));
        $this->deliveryEquipments = implode(', ', json_decode($load->delivery_equipments));
    }
}
