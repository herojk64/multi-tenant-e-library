<?php

namespace App\Livewire\Landlord;

use App\Enum\ServicesType;
use App\Livewire;
use App\Models\LandlordServices;
use Livewire\Component;

class Services extends Component
{
    public $section;
    public $types;
    public $services;
    public $tenant;

    public function mount($tenant=null)
    {
        $this->tenant = $tenant;
        $this->types = ServicesType::cases();
        $this->section = $this->types[0]->value; // Default to the first type
        $this->services = LandlordServices::query()->where('type',$this->section)->get();
    }

    public function toggle($type)
    {
        $this->section = $type;
        $this->services = LandlordServices::query()->where('type',$type)->get();
    }

    public function render()
    {
        return view('livewire.landlord.services');
    }
}
