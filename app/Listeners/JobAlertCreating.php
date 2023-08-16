<?php

namespace App\Listeners;

use App\JobAlert;
use App\Seeker;
use App\WebStat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\Events\JobAlertCreating as JobAlertCreatingEvent;

class JobAlertCreating
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(JobAlertCreatingEvent $event)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $alert = $event->job_alert;


        $stats = WebStat::first();
        if(!$stats){
            $stats = new WebStat();
        }
        $stats->total_alerts = $stats->total_alerts +1;
        $stats->save();

        $alert = JobAlert::find($alert->id);
        if($alert->is_seeker == 1){
            $seeker = Seeker::where('email', $alert->email)->first();
            $seeker->total_alerts = $seeker->total_alerts + 1;
            $seeker->save();
        }


    }
}
