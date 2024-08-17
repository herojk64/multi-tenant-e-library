<?php
namespace App\Filament\Resources\Landlord\TenantResource\Pages;

use App\Filament\Resources\Landlord\TenantResource;
use App\Models\Tenant;
use Filament\Resources\Pages\ViewRecord;

class ViewTenants extends ViewRecord
{
    protected static string $resource = TenantResource::class;

}
