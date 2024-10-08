<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function(){
                Route::middleware('web')->name('landlord.')->group(base_path('routes/web.php'));
                Route::middleware(['web','tenant'])->group(base_path('routes/tenant.php'));
                Route::middleware('web')->group(base_path('routes/universal.php'));
        },
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->appendToGroup('tenant',[
            \Spatie\Multitenancy\Http\Middleware\NeedsTenant::class,
            \Spatie\Multitenancy\Http\Middleware\EnsureValidTenantSession::class,
        ]);
        $middleware->appendToGroup('web',[
            \App\Http\Middleware\SetHostForTesting::class
        ]);

        $middleware->redirectGuestsTo('/login');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
