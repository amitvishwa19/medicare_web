<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class AutoDeployController extends Controller
{
    public function deploy(Request $request)
    {
        activity('Github')->log('New github push @' . Carbon::now());

        Artisan::call('git:pull');
        return response()->json(['message'=>'Successfully delivered notification'],200);
    }

    public function gitDeploy(Request $request){

        return 'Git Deploy';

    }
}
