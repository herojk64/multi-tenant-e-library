<?php

namespace App\Http\Controllers\Landlord;

use App\Enum\ServicesStatusType;
use App\Enum\ServicesType;
use App\Http\Controllers\Controller;
use App\Models\LandlordServices;
use App\Models\PasswordResetToken;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class LandlordServiceController extends Controller
{
    public function index()
    {
        $types = ServicesType::cases();
        $data = LandlordServices::all();
        return view('landlord.services.index',['types' => $types,'data'=>$data]);
    }

    public function pay(LandlordServices $landlordServices){
        return view('landlord.services.pay',[
            'service' => $landlordServices
        ]);
    }
    public function store(LandlordServices $landlordServices, Request $request)
    {
        $attributes = $request->validate([
            'domain' => ['string', 'required', 'regex:/^[a-zA-Z]+$/']
        ]);

        $name = strtolower($attributes['domain']);
        $domain = $name.".".config('app.url');

        $tenantExists = Tenant::where('domain', $domain)->exists();

        if ($tenantExists) {
            return back()->withErrors([
                'domain' => 'Domain name already taken'
            ]);
        }

        $data = [
            'name'=>$name,
            'email'=>auth()->user()->email,
            'domain' => $domain
        ];
        $services = $landlordServices->only(['title','description','type','duration','amount','discount']);
        $services['total'] = $services['amount'] - ($services['amount']*($services['discount']/100));

        $newTenant = Tenant::create($data);

        $services['tenant_id'] = $newTenant->id;
        $services['status'] = ServicesStatusType::INACTIVE;

        $newTenant->services()->create($services);

        Toaster::success('Your service has been added. Please wait your service evaluation process. You will get mail with further instructions.');
        return redirect()->route('landlord.home');
    }

    public function select(Tenant $tenant)
    {
        if($tenant->status !== 'Expired'){
            abort(404);
        }
        return view('landlord.services.select',[
            'tenant'=>$tenant
        ]);
    }

    public function updateView(Tenant $tenant,LandlordServices $landlordServices)
    {
        if($tenant->status !== 'Expired'){
            abort(404);
        }

        return view('landlord.services.pay',[
            'service' => $landlordServices,
            'tenant' => $tenant
        ]);
    }

    public function update(Tenant $tenant,LandlordServices $landlordServices)
    {
        if($tenant->status !== 'Expired'){
            abort(404);
        }
        $services = $landlordServices->only(['title','description','type','duration','amount','discount']);
        $services['total'] = $services['amount'] - ($services['amount']*($services['discount']/100));
        $services['status'] = ServicesStatusType::ACTIVE;
        $services['tenant_id'] = $tenant->id;
        $services['activation_date'] = now();
        $tenant->services()->create($services);
        $tenant->is_active = true;
        $tenant->save();
        Toaster::success('Your service has been updated.');
        return redirect()->route('landlord.dashboard');
    }
}
