<?php

namespace App\Filament\TenantAdmin\Resources\SettingsResource\Pages;

use App\Filament\TenantAdmin\Resources\SettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSettings extends CreateRecord
{
    protected static string $resource = SettingsResource::class;
}
