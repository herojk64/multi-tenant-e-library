<?php

namespace App\Filament\Resources\AdminPanelResource\Widgets;

use App\Models\TenantService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ServicesChart extends ChartWidget
{
    protected static ?string $heading = 'ServicesReview';

    protected static ?string $description = "Prices of services during a year";

    protected function getData(): array
    {
        $tenant_services = TenantService::query()->where('created_at','>',Carbon::now()->subMonth())->get();
        $count = $tenant_services->count();


        return [
            'datasets'=>[
                [
                'label'=>'Total',
                'data'=>$tenant_services->map(fn($record)=>$record->total)
            ],
                [
                    'label'=>'Amount',
                    'data'=>$tenant_services->map(fn($record)=>$record->amount),
                    'color'=>'yellow'
                ],
                [
                    'label'=>'Discount',
                    'data'=>$tenant_services->map(fn($record)=>$record->discount),
                    'color'=>'yellow'
                ]
                ],
            'labels'=>$tenant_services->map(fn($reccord)=>Carbon::make($reccord['created_at'])->format('Y-m-d'))
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
