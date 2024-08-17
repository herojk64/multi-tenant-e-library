<?php

namespace App\Livewire\Landlord\Tables;

use App\Enum\ServicesStatusType;
use App\Models\Tenant;
use Filament\Actions\ViewAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ServiceTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Tenant::query()->where('user_id', auth()->user()->id))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('domain')
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
                Tables\Actions\ViewAction::make('View')->url(fn(Tenant $state)=> route('landlord.dashboard.view',$state)
                )
                    ->button()
                ,
                Tables\Actions\Action::make('Activate')
                    ->button()
                    ->url(fn($record)=>route('landlord.services.select',$record))
                    ->color('success')
                ->visible(fn($record)=>$record->status === "Expired")
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public function render(): View
    {
        return view('livewire.landlord.tables.service-table');
    }
}
