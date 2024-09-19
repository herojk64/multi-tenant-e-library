<?php

namespace App\Filament\Resources\AdminPanelResource\Widgets;

use App\Models\Tenant;
use Filament\Widgets\Widget;

class InactiveTenantAlert extends Widget
{
    // Data property to hold the count of inactive tenants
    public int $inactiveTenantCount;

    protected static string $view = 'filament.widgets.inactive-tenant-alert';

    // Initialize data in the constructor
    public function mount()
    {
        $this->inactiveTenantCount = Tenant::where('is_active', false)->count();
    }

    // Alternatively, use this method to fetch data before rendering
    public function message()
    {
        return $this->inactiveTenantCount > 0
            ? "There are {$this->inactiveTenantCount} inactive tenants."
            : "All tenants are active.";
    }
}
