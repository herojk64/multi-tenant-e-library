<?php

namespace App\Filament\TenantAdmin\Resources\ServicesResource\Pages;

use App\Filament\TenantAdmin\Resources\ServicesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServices extends EditRecord
{
    protected static string $resource = ServicesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
