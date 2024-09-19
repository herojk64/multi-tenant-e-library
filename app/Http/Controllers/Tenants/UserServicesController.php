<?php

namespace App\Http\Controllers\Tenants;

use App\Enum\ServicesStatusType;
use App\Enum\ServicesType;
use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\UserServices;
use Illuminate\Http\Request;
use Masmerise\Toaster\Toaster;

class UserServicesController extends Controller
{
    public function index()
    {
        $types = ServicesType::cases();
        $data = Services::all();
        return view('tenants.services.index',['types' => $types,'data'=>$data]);
    }

    public function pay(Services $service){
        return view('tenants.services.pay',[
            'service' => $service
        ]);
    }
    public function store(Services $service)
    {
        $userId = auth()->user()->id;

        // Check if the user has any active services
        $activeService = UserServices::where('user_id', $userId)
            ->where('status', ServicesStatusType::ACTIVE)
            ->first();

        // Prepare the service data
        $services = $service->only(['title', 'description', 'type', 'duration', 'amount', 'discount']);
        $services['total'] = $services['amount'] - ($services['amount'] * ($services['discount'] / 100));
        $services['status'] = $activeService ? ServicesStatusType::INACTIVE : ServicesStatusType::ACTIVE;
        $services['user_id'] = $userId;

        // Create the user's service
        UserServices::create($services);

        // Notify the user and redirect
        if($activeService){
            Toaster::success('Your service has been added.');
        }else{
            Toaster::success('Your service has been activated.');
        }
        return redirect()->route('home');
    }


    public function select(Tenant $tenant)
    {
        if($tenant->status !== 'Expired'){
            abort(404);
        }
        return view('services.select',[
            'tenant'=>$tenant
        ]);
    }

}
