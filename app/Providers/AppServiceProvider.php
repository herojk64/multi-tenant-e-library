<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\ServiceProvider;
use Spatie\Multitenancy\Models\Tenant;

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
        //
        if (!Tenant::current() && request()->getSchemeAndHttpHost() === config('multitenancy.landlord_url')) {
            config(['database.default' => 'landlord']);
        } else {
            config(['database.default' => 'tenant']);
        }
    }
}
