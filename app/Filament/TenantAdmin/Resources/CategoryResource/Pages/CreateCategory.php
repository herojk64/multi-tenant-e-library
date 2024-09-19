<?php

namespace App\Filament\TenantAdmin\Resources\CategoryResource\Pages;

use App\Filament\TenantAdmin\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
