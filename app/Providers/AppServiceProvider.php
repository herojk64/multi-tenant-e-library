<?php

namespace App\Providers;

use App\Enum\BookType;
use App\Enum\UserType;
use App\Models\Books;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
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

        if ($type === "tenant") {
            $this->loadTenantSettings();

            $setting = Cache::get('tenant.settings');

            if ($setting && $setting['site_name']) {
                config([
                    'app.name' => $setting['site_name'], // Update the app name configuration
                ]);
            }
        }

        $this->setGates();
    }

    protected function loadTenantSettings(): void
    {
        // Try to fetch settings from the cache; if not available, load from DB
        Cache::remember('tenant.settings', 3600, function () {
            return Settings::all()->pluck('value', 'key');
        });


    }

    public function checkTenantActive()
    {
        $tenant = Tenant::current();
        if($tenant && !$tenant->is_active){
            abort(404);
        }
    }

    public function setGates()
    {
        Gate::define('landlord.admin',function(User $user){
        return $user->type === UserType::LANDLORD;
    });

        Gate::define('admin',function(User $user){
            return $user->type === UserType::ADMIN;
        });

        Gate::define('view-content', function (User $user, Books $book) {
            // Assuming you want to check if the book requires a subscription
            if (!auth()->check()) {
                return false;
            }

            if ($user->type === UserType::ADMIN) {
                return true;
            }

            if ($book->type === BookType::FREE) {
                return true;
            }

            // Check if the user is subscribed (you can add your own logic here)
            return auth()->user()->status;
        });

    }
}
