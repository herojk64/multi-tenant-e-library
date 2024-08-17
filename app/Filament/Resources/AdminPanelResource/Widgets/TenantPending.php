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
        return [
            'datasets'=>[
                [
                'data'=>[$tenants->filter(fn($value)=>$value->is_active)->count(),$tenants->filter(fn($value)=>!$value->is_active)->count()],
                    'color'=>'success'
            ]
                ],
                    'labels'=>['Active','In Active']
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
