<?php

namespace App\ViewModel\Links;

use App\Models\Link;
use App\Models\Load;
use App\Models\Movement;
use Spatie\ViewModels\ViewModel;

class LinkViewModel extends ViewModel
{
    public $link;
    public $load;
    public $movement;
    public $pickupEquipments;
    public $deliveryEquipments;

    public function __construct($id)
    {
        $this->link = Link::where('id', $id)->first();
        $this->load = Load::where('id', $id)->first();
        $this->movement = Movement::where('id', $id)->first();
        $this->pickupEquipments = implode(', ', json_decode($this->load->pickup_equipments));
        $this->deliveryEquipments = implode(', ', json_decode($this->load->delivery_equipments));
    }
}
