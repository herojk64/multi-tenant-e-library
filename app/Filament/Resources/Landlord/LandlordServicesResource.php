<?php

namespace App\Filament\Resources\Landlord;

use App\Enum\ServicesType;
use App\Filament\Resources\Landlord;
use App\Filament\Resources\LandlordServicesResource\Pages;
use App\Filament\Resources\LandlordServicesResource\RelationManagers;
use App\Models\LandlordServices;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LandlordServicesResource extends Resource
{
    protected static ?string $model = LandlordServices::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $label = 'Services';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('type')->options(ServicesType::class)
                    ->required(),
                Forms\Components\TextInput::make('duration')
                    ->required()->default(1)
                    ->numeric(),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()->default(0),
                Forms\Components\TextInput::make('discount')
                    ->required()
                    ->numeric()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('duration')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Landlord\LandlordServicesResource\Pages\ListLandlordServices::route('/'),
            'create' => Landlord\LandlordServicesResource\Pages\CreateLandlordServices::route('/create'),
            'edit' => Landlord\LandlordServicesResource\Pages\EditLandlordServices::route('/{record}/edit'),
        ];
    }
}
