<?php

use App\Http\Controllers\LandlordAuthentication;
use App\Http\Controllers\Landlord\LandlordHome;
use App\Http\Controllers\LandlordServiceController;
use Illuminate\Support\Facades\Auth;
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
        Route::get('reset-password/{token}','reset_view')->middleware('guest')->name('password.reset');
        Route::post('reset-password','resetPassword')->middleware('guest')->name('password.update');
        Route::post('logout','logout')->withoutMiddleware('guest')->middleware('auth:web')->name('logout');
    });

    Route::controller(LandlordServiceController::class)->group(function(){
        Route::get('services','index')->name('services');
        Route::get('services/{id}/pay','pay')->middleware('auth')->name('pay');
        Route::post('services/{id}/pay','store')->middleware('auth')->name('pay-services');
    });


});


