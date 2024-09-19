<?php

namespace App\Filament\Resources\AdminPanelResource\Widgets;

use App\Models\Tenant;
use Filament\Widgets\ChartWidget;

class TenantPending extends ChartWidget
{
    protected static ?string $heading = 'Tenants Status';
    protected static string $color = 'primary';

    protected function getData(): array
    {
        $tenants = Tenant::all();

        // Initialize counters
        $activeCount = 0;
        $inactiveCount = 0;
        $expiredCount = 0;

        // Count tenants based on their status
        foreach ($tenants as $tenant) {
            switch ($tenant->status) {
                case 'Active':
                    $activeCount++;
                    break;
                case 'Inactive':
                    $inactiveCount++;
                    break;
                case 'Expired':
                    $expiredCount++;
                    break;
            }
        }

        return [
            'datasets' => [
                [
                    'data' => [$activeCount, $inactiveCount, $expiredCount],
                    'backgroundColor' => [
                        'rgba(76, 175, 80, 0.5)', // Light green with 50% opacity
                        'rgba(244, 67, 54, 0.5)', // Light red with 50% opacity
                        'rgba(255, 193, 7, 0.5)'  // Light yellow with 50% opacity
                    ],
                ],
            ],
            'labels' => ['Active', 'Inactive', 'Expired'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
