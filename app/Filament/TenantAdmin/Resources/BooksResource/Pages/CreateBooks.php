<?php

namespace App\Filament\TenantAdmin\Resources\BooksResource\Pages;

use App\Filament\TenantAdmin\Resources\BooksResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBooks extends CreateRecord
{
    protected static string $resource = BooksResource::class;
}
