<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Services\FirebaseMessaging;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class FcmDailyNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //activity('FCM')->log('Send FCM Daily Notification');
        $fcm = new FirebaseMessaging;
        $fcm->title =  'Daily Notification';
        $fcm->body = 'This is daily Notification test';
        $fcm->data = array
        (
            'message'   => 'data-1',
            'productId' => '632180',
        );
        $fcm->users =  User::whereNotNull('fcm_device_id')->pluck('fcm_device_id')->all();
        $fcm->send();
    }
}
