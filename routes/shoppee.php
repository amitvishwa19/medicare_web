<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;

use App\Http\Controllers\Admin\SandboxController;
use App\Http\Controllers\Shoppee\ProductController;
use App\Http\Controllers\Shoppee\FirebaseController;
use App\Http\Controllers\Shoppee\DashboardController as ShoppeeDashboardController;




Route::get('/',[ShoppeeDashboardController::class,'index'])->name('dashboard');

Route::resource('/slider',SliderController::class);

Route::resource('/product',ProductController::class);

Route::group(['prefix' => 'fcm'], function () {
    Route::get('/',[FirebaseController::class,'index'])->name('fcm');
    Route::post('/send',[FirebaseController::class,'send_message'])->name('fcm.send');
    Route::get('/send/dailynotifications',[FirebaseController::class,'send_daily_notification'])->name('fcm.send.dailynotification');
});