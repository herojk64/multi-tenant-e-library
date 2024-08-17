<?php

namespace App\Filament\Resources\Landlord;

use App\Enum\ServicesStatusType;
use App\Filament\Resources\Landlord;
use App\Filament\Resources\Landlord\TenantResource\Pages\ViewTenants;
use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Termwind\Enums\Color;

class TenantResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                ,
                Forms\Components\TextInput::make('domain')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                    ])->heading('Details')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('domain')
                    ->searchable(),
                Tables\Columns\TextColumn::make('database')
                    ->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                ->badge()
                ->color(fn($state)=>match($state){
                    'Active'=>'success',
                    'Inactive'=>'danger',
                    default =>"warning"
                })
                ,
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
                Tables\Actions\ViewAction::make('View'),
                Tables\Actions\Action::make('initial')
                    ->label('Activate')
                    ->button()
                    ->visible(function ($record) {
                        return !$record->initial;
                    })
                    ->action(function ($record) {
                        $service = $record->services()->first();
                        $service->status = ServicesStatusType::ACTIVE->value;
                        $service->activation_date = now();
                        $service->save(); // Save the service record

                        // Optionally, update tenant's attributes
                        $record->initial = true;
                        $record->is_active = true;
                        $record->save(); // Save the tenant record
                        Tenant::runSeeders($record->id);
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
    }


    public static function getRelations(): array
    {
        return [
            ServiceRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Landlord\TenantResource\Pages\ListTenants::route('/'),
            'view' => Landlord\TenantResource\Pages\ViewTenants::route('/{record}')
        ];
    }
}
