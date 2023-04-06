<?php

namespace App\Http\Controllers\Shoppee;

use Carbon\Carbon;
use App\Models\User;
use App\Services\FCM;
use App\Services\Test;
use Illuminate\Http\Request;
use App\Services\FirebaseMessaging;
use App\Http\Controllers\Controller;

class FirebaseController extends Controller
{
    public function __construct(){


    }

    public function index()
    {
        
        return view('admin.pages.fcm.fcm');
    }

    public function send_message(Request $request){

        

        $fcm = new FirebaseMessaging;
        $fcm->title =  $request->title;
        $fcm->body = $request->body;
        $fcm->data = array
        (
            'message'   => 'data-1',
            'productId' => '632180',
        );
        $fcm->users =  User::whereNotNull('fcm_device_id')->pluck('fcm_device_id')->all();
        $fcm->send();


        return redirect() ->route('shoppee.fcm')
        ->with([
            'message'    =>'Notification sent Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function send_daily_notification(){

        activity('FCM')->log('Called from controller');

    }
}
