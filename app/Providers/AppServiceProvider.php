<?php

namespace App\Providers;

use App\Enum\UserType;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Spatie\Multitenancy\Models\Tenant;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //if the typeCheck is true it means the database is landlord else use the database of the given tender
        $typeCheck = !Tenant::current() && request()->getSchemeAndHttpHost() === config('multitenancy.landlord_url');
        $type = $typeCheck ? 'landlord' : 'tenant';
        config(['database.default' => $type]);
        DB::setDefaultConnection($type);

        if($type === "tenant"){
            $tenant = Tenant::current();
            $this->checkTenantActive();

        }

        Gate::define('landlord.admin',function(User $user){
            return $user->type === UserType::LANDLORD;
        });

        Gate::define('admin',function(User $user){
           return $user->type === UserType::ADMIN;
        });
    }

    public function checkTenantActive()
    {
        $tenant = Tenant::current();
        if($tenant && !$tenant->is_active){
            abort(404);
        }
    }
}
