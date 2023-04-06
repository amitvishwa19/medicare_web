<?php

namespace App\Http\Controllers\Shoppee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        //return 'Shoppee Dashboard';
        return view('shoppee.dashboard.dashboard');
    }
}

