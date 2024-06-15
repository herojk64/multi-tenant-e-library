<?php

use Illuminate\Support\Facades\Route;

Route::domain(config('multitenancy.landlord_url'))->group(function (){

//Route::get('/',[\App\Http\Controllers\LandLordHomePage::class,'index']);
});
