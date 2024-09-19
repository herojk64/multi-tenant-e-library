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
            'datasets' => [
                [
                    'label' => 'Total',
                    'data' => $tenant_services->map(fn($record) => $record->total),
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Light green
                    'borderColor' => 'rgba(75, 192, 192, 1)', // Dark green
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Amount',
                    'data' => $tenant_services->map(fn($record) => $record->amount),
                    'backgroundColor' => 'rgba(255, 159, 64, 0.2)', // Light orange
                    'borderColor' => 'rgba(255, 159, 64, 1)', // Dark orange
                    'borderWidth' => 1
                ],
                [
                    'label' => 'Discount',
                    'data' => $tenant_services->map(fn($record) => $record->discount),
                    'backgroundColor' => 'rgba(153, 102, 255, 0.2)', // Light purple
                    'borderColor' => 'rgba(153, 102, 255, 1)', // Dark purple
                    'borderWidth' => 1
                ]
            ],
            'labels' => $tenant_services->map(fn($record) => Carbon::make($record->created_at)->format('Y-m-d'))
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
