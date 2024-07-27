<?php

namespace App\Filament\Resources\AdminPanelResource\Widgets;

use App\Models\LandlordServices;
use App\Models\Tenant;
use App\Models\TenantService;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use mysql_xdevapi\Collection;

class ServicesChart extends ChartWidget
{
    protected static ?string $heading = 'Services';

    protected static ?string $description = "Prices of services during a year";

    protected function getData(): array
    {
        $tenant_services = TenantService::query()->where('created_at','>',Carbon::now()->subYear())->get();
        $count = $tenant_services->count();

        $data = $tenant_services->map(function($data){
            $service = $data['service'];
            $amount = $service['amount'];
            $discount = $amount*$service['discount']/100;
            $total = $amount - $discount;
            $created_at = $service['created_at'];

            return compact('amount','discount','total','created_at');
        });


        return [
            'datasets'=>[
                [
                'label'=>'Total',
                'data'=>$data->map(fn($record)=>$record['total'])
            ],
                [
                    'label'=>'Amount',
                    'data'=>$data->map(fn($record)=>$record['amount']),
                    'color'=>'yellow'
                ],
                [
                    'label'=>'Discount',
                    'data'=>$data->map(fn($record)=>$record['discount']),
                    'color'=>'yellow'
                ]
                ],
            'labels'=>$data->map(fn($record)=>Carbon::make($record['created_at'])->format('Y-m-d'))
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
