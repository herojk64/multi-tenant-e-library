<?php

namespace App\Console\Commands;

use App\Enum\ServicesStatusType;
use App\Enum\ServicesType;
use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CheckTenantStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-tenant-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is responsible for checking tenant status by seeing services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenants = Tenant::where('is_active',true)->get();
        foreach($tenants as $tenant){
            $service = $tenant->services()->where('status',ServicesStatusType::ACTIVE)->first();
            $expire = $this->checkExpireOrNot($service);
            if($expire){
                $service->status = ServicesStatusType::EXPIRED;
                $tenant->is_active = false;
                $service->save();
                $tenant->save();
            }
        }
    }

    public function checkExpireOrNot($service):bool
    {
        $expireDate = match ($service->type) {
            ServicesType::MONTHLY->value => Carbon::create($service->activation_date)->addMonths($service->duration),
            ServicesType::YEARLY->value => Carbon::create($service->activation_date)->addYears($service->duration),
            default => null,
        };

        if (!$expireDate) {
            return false;
        }

        return Carbon::now()->greaterThanOrEqualTo($expireDate);
    }
}
