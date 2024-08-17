<?php

namespace App\Filament\TenantAdmin\Resources\BooksResource\Pages;

use App\Filament\TenantAdmin\Resources\BooksResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBooks extends EditRecord
{
    protected static string $resource = BooksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
