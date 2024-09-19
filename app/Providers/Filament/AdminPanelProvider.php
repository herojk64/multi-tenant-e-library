<?php

namespace App\Providers\Filament;

use App\Filament\Resources\AdminPanelResource\Widgets\InactiveTenantAlert;
use App\Filament\Resources\AdminPanelResource\Widgets\ServicesChart;
use App\Filament\Resources\AdminPanelResource\Widgets\TenantPending;
use App\Filament\Resources\Landlord\LandlordServicesResource;
use App\Filament\Resources\Landlord\TenantResource;
use App\Filament\Resources\Landlord\UserResource;
use App\Http\Middleware\LandlordPannelMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('/admin')
            ->domain(config('multitenancy.landlord_url'))
            ->login()
            ->spa()
            ->colors([
                'primary' => Color::hex('#03001C'),
                'gray'=> Color::hex('#301E67'),
                'info'=> Color::hex('#B6EADA')
            ])
            ->resources([
                UserResource::class,
                TenantResource::class,
                LandlordServicesResource::class
            ])
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
//                InactiveTenantAlert::class,
                ServicesChart::class,
                TenantPending::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                LandlordPannelMiddleware::class,
                Authenticate::class,
            ])
            ->darkMode(false)
            ;
    }
}
