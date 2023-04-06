<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;

class DeleteActivityLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deleteactivitylog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will delete activity log older than 10 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $activities = Activity::where('created_at','<',Carbon::now()->subMinutes(60))->delete();
        if($activities > 0){
            activity('Activity Log Clear')->log('All Activity log is deleted at ' . Carbon::now());
        }
    }
}
