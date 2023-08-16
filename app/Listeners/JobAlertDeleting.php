<?php

namespace App\Listeners;

use App\Seeker;
use App\WebStat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JobAlertDeleting
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(\App\Events\JobAlertDeleting $event)
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
        $stats->total_alerts = $stats->total_alerts - 1;
        if($stats->total_alerts < 0){
            $stats->total_alerts = 0;
        }
        $stats->save();

        if($alert->is_seeker = 1){
            $seeker = Seeker::where('email', $alert->email)->first();
            if( $seeker ){

                $seeker->total_alerts = $seeker->total_alerts - 1;
                if($seeker->total_alerts < 0){
                    $seeker->total_alerts = 0;
                }
                $seeker->save();
            }
        }
    }
}
