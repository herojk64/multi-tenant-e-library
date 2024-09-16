<?php

namespace App\Filament\TenantAdmin\Resources\ServicesResource\Pages;

use App\Filament\TenantAdmin\Resources\ServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
