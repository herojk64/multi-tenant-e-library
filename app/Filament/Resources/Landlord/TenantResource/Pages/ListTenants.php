<?php

namespace App\Filament\Resources\Landlord\TenantResource\Pages;

use App\Filament\Resources\Landlord\TenantResource;
use App\Models\Tenant;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTenants extends ListRecords
{
    protected static string $resource = TenantResource::class;

    public function getTabs(): array
    {
        return [
            'active' => Tab::make("Active Tenants")->modifyQueryUsing(fn(Builder $query) => $query->where('is_active',true)->where('initial',true)),
            'initial' => Tab::make("New Initial Tenants")
                ->badge(Tenant::query()->where('initial',false)->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('initial', false)),
            'inactive' => Tab::make("Inactive Tenants")
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_active', false)->where('initial',true)),
        ];
    }
}
