<?php

namespace App\Http\Controllers;

use App\Enum\ServicesType;
use App\Filament\Resources\LandlordServicesResource\Pages\CreateLandlordServices;
use App\Models\LandlordServices;
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

    public function pay($id){
        $services = LandlordServices::query()->where('id',$id)->get()->first();
        return view('landlord.pay',[
            'services' => $services
        ]);
    }
    public function store($id, Request $request)
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

        $service = LandlordServices::findOrFail($id);

        $newTenant = Tenant::create([
            'name'=>$name,
            'email'=>auth()->user()->email,
            'domain' => $domain,
            'is_active' => true
        ]);

        $newTenant->services()->create([
            'service' => $service->toArray()
        ]);

        Toaster::success('Your service has been activated please check your email for further instructions.');
        return redirect()->route('landlord.home');
    }
}
