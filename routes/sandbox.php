<?php

use App\Http\Controllers\Admin\SandboxController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/trading',[SandboxController::class,'stockMarket'])->name('admin.sandbox.trading');