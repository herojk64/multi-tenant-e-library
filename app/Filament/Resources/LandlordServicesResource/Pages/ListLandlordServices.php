<?php

namespace App\Filament\Resources\LandlordServicesResource\Pages;

use App\Filament\Resources\LandlordServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLandlordServices extends ListRecords
{
    protected static string $resource = LandlordServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
