<?php

use Illuminate\Support\Facades\Route;

Route::get('/',[\App\Http\Controllers\Tenants\TenantHomeController::class,'index']);
Route::get('/home',[\App\Http\Controllers\Tenants\TenantHomeController::class,'index'])->name('home');
Route::get('/about',[\App\Http\Controllers\Tenants\AboutController::class,'index'])->name('about');

Route::controller(\App\Http\Controllers\Tenants\BooksController::class)->group(function(){
    Route::get('/books','index')->name('books');
    // web.php

    Route::get('/books/{book}', 'show')->name('books.show');

});


Route::controller(\App\Http\Controllers\Tenants\AuthController::class)->middleware('guest')->group(function(){
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

Route::controller(\App\Http\Controllers\Tenants\ProfileDashboard::class)->middleware('auth')->group(function(){
    Route::get('profile','index')->name('profile');
    Route::put('profile','changePassword')->name('profile.update-password');
//    Route::get('dashboard','services')->name('dashboard');
//    Route::get('dashboard/view/{tenant}','view')->name('dashboard.view');
});
