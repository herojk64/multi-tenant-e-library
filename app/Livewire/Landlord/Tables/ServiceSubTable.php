<?php

namespace App\Livewire\Landlord\Tables;

use App\Enum\ServicesStatusType;
use App\Models\Tenant;
use App\Models\TenantService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ServiceSubTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $tenantId;
    public function mount($tenantId)
    {
        $this->tenantId = $tenantId;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(TenantService::query()->where('tenant_id', $this->tenantId))
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
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.landlord.tables.service-sub-table');
    }
}
