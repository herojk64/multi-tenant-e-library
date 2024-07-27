<?php

namespace App\Tasks;

use Illuminate\Http\Request;
use Spatie\Multitenancy\Models\Concerns\UsesTenantModel;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\TenantFinder\TenantFinder;

class DomainFinderCustomTask  extends TenantFinder
{
    use UsesTenantModel;

    public function findForRequest(Request $request): ?Tenant
    {
        $host = $request->getHost();
        $landlord = parse_url(config('multitenancy.landlord_url'))['host'];

        $tenant = $this->getTenantModel()::whereDomain($host)->first();

        if($host === $landlord){
            return $tenant;
        }

        if($tenant->services->isEmpty()){
            return abort(403);
        }

        $service = $tenant->services()->latest()->first()->pluck('service');


            dd($service);
        return $tenant;
    }
}
