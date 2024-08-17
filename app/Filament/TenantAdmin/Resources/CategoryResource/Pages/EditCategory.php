<?php

namespace App\Filament\TenantAdmin\Resources\CategoryResource\Pages;

use App\Filament\TenantAdmin\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use function PHPUnit\Framework\isEmpty;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->visible(function($record){
                return isEmpty($record->books);
            }),
        ];
    }
}
