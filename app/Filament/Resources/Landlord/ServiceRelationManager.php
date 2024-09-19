<?php

namespace App\Filament\Resources\Landlord;

use App\Enum\ServicesStatusType;
use Filament\Forms\Components\Section;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceRelationManager extends RelationManager
{
    protected static string $relationship = 'services';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('duration'),
                TextColumn::make('type'),
                TextColumn::make('total'),
                TextColumn::make('amount'),
                TextColumn::make('discount')
                ->formatStateUsing(fn($state)=>$state."%")
                ,
                TextColumn::make('status')
                    ->badge()
                ->color(fn($state)=> match($state){
                    ServicesStatusType::INACTIVE =>'warning',
                    ServicesStatusType::EXPIRED =>'danger',
                    default => 'success'
                })
            ]);
    }
}
