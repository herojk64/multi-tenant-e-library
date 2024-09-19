<?php

namespace App\Filament\TenantAdmin\Resources\BooksResource\Pages;

use App\Filament\TenantAdmin\Resources\BooksResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBooks extends ListRecords
{
    protected static string $resource = BooksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
