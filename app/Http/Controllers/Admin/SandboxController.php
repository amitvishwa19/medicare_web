<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\AppMail;
use App\Mail\TestMail;
use App\Facades\Counts;
use App\Jobs\TestMailJob;
use App\Services\MenuCounts;
use Illuminate\Http\Request;
use App\Services\AppMailingService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\InquiryNotification;
use App\Services\Fyers;

class SandboxController extends Controller
{
    public function mail(){

        //$mail->test();
        //dd(app());
        //dd(app()->make('Hello'));
        return view('admin.pages.sandbox.mail');
    }

    public function simpleMail(AppMailingService $mail){


        $to = 'amitvishwa19@gmail.com';
        $from = 'info@devlomatix.com';
        $subject = 'Test mail send by AppMail mailer class,Simple mail without job';
        $body = 'This is the mail body of test mail';
        $data =["title" => "hello", "description" => "test test test"];
        $view = 'mails.testmail';

        //Mail::to('jaysvishwa@gmail.com')->send(new TestMail);
        //$mail = Mail::to($to)->send(new AppMail($subject,$body));

        $mail->sendMail($to,$subject,$body,$data,$view);


        return redirect() ->route('sandbox.mail')
        ->with([
            'message'    =>'Mail sent successfully',
            'alert-type' => 'success',
        ]);
    }

    public function dispatchMail(AppMailingService $mail){
        $to = 'amitvishwa19@gmail.com';
        $from = 'info@devlomatix.com';
        $subject = 'Test mail send by AppMail mailer class,Simple mail with job';
        $body = 'This is the mail body of test mail';
        $data =["title" => "hello", "description" => "test test test"];
        $view = 'mails.wola';

        $mail->sendMailJob($to,$subject,$body,$data,$view);


        return redirect() ->route('sandbox.mail')
        ->with([
            'message'    =>'Mail sent successfully with dispatch job',
            'alert-type' => 'success',
        ]);
    }

    public function dispatchMailCustom(Request $request,AppMailingService $mail)
    {

        $validate = $request->validate([
            'to' => 'required',
        ]);


        $to = $request->to;
        $from = 'info@devlomatix.com';
        $subject = $request->subject;
        $body = $request->message;
        $data = null;
        $view = 'mails.wola';


        $mail->sendMailJob($to,$subject,$body);


        return redirect() ->route('sandbox.mail')
        ->with([
            'message'    =>'Custom Mail sent successfully with dispatch job',
            'alert-type' => 'success',
        ]);

    }


    public function stockMarket(Request $request){

        $access_token = null;
        $profile = null;
        $funds = null;
        $orders = null;
        $trades = null;

        $fyers = new Fyers;
        $fyers_auth_url = $fyers->auth_url();

        
        $auth_code =  $request->auth_code;

        if(!$auth_code == null){
            $access_token = $fyers->access_token($auth_code);
            //$profile = $fyers->get_profile($access_token);
            //$funds = $fyers->get_funds($access_token);
            //$orders = $fyers->get_order_book($access_token);
            //$trades = $fyers->get_trades($access_token);
        }
        


        
        
        
        
    
        
        
        return view('admin.pages.sandbox.trading',compact('fyers_auth_url','auth_code','access_token'));
           

    }
}
