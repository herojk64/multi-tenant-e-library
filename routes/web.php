<?php

use App\Http\Controllers\Landlord\LandlordAuthentication;
use App\Http\Controllers\Landlord\LandlordHome;
use App\Http\Controllers\Landlord\LandlordProfileDashboard;
use App\Http\Controllers\Landlord\LandlordServiceController;
use Illuminate\Support\Facades\Route;

Route::domain(config('multitenancy.landlord_url'))->group(callback: function (){
    Route::get('/home',[LandlordHome::class,'index']);
    Route::get("/",[LandlordHome::class,'index'])->name('home');

    Route::controller(LandlordAuthentication::class)->middleware('guest')->group(function(){
        Route::get('login','index')->name('login');
        Route::post('login','login');
        Route::get('register','register')->name('register');
        Route::post('register','store');
        Route::get('password/forget','forget')->name('password.request');
        Route::post('password/forget','sendForgetPasswordConfirmation')->name('password.email');
        Route::get('reset-password/{token}','reset_view')->name('password.reset');
        Route::put('reset-password','resetPassword')->name('password.update');
        Route::post('logout','logout')->withoutMiddleware('guest')->middleware('auth:web')->name('logout');
    });

    Route::get('about',[\App\Http\Controllers\Landlord\AboutUsController::class,'index'])->name('about');
//
    Route::controller(LandlordServiceController::class)->group(function(){
        Route::get('services','index')->name('services');
        Route::get('services/{landlordServices}/pay','pay')->middleware('auth')->name('services.pay');
        Route::post('services/{landlordServices}/pay','store')->middleware('auth')->name('services.pay-services');
        Route::get('services/{tenant}','select')->middleware('auth')->name('services.select');
        Route::get('services/{tenant}/pay/{landlordServices}','updateView')->middleware('auth')->name('services.update-view');
        Route::post('services/{tenant}/pay/{landlordServices}','update')->middleware('auth')->name('services.update');
    });


    Route::controller(LandlordProfileDashboard::class)->middleware('auth')->group(function(){
        Route::get('profile','index')->name('profile');
        Route::put('profile','changePassword')->name('profile.update-password');
        Route::get('dashboard','services')->name('dashboard');
        Route::get('dashboard/view/{tenant}','view')->name('dashboard.view');
    });

});


