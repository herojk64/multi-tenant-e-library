<?php

namespace App\Livewire\Tenants;

use App\Enum\ServicesType;
use App\Models\Services;
use Livewire\Component;

class ServicesViewer extends Component
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
        $this->services = Services::query()->where('type',$this->section)->get();
    }

    public function toggle($type)
    {
        $this->section = $type;
        $this->services = Services::query()->where('type',$type)->get();
    }

    public function render()
    {
        return view('livewire.tenants.services-viewer');
    }
}
