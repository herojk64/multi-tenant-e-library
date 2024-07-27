<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

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
        $tenants = Tenant::all();
        foreach($tenants as $tenant){
            dd($tenant);
        }
    }
}
