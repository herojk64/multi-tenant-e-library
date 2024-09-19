<?php

namespace App\Filament\TenantAdmin\Resources\SettingsResource\Pages;

use App\Filament\TenantAdmin\Resources\SettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettings extends ListRecords
{
    protected static string $resource = SettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
