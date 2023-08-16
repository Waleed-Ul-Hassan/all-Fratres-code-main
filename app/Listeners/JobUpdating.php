<?php

namespace App\Listeners;

use App\City;
use App\Industry;
use App\Job;
use App\Skill;
use App\WebStat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\Events\JobUpdating as JobUpdatingEvent;

class JobUpdating
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(JobUpdatingEvent $event)
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
        $job = $event->job;

        if ($job->is_external != 1) {
//            dd($job->city);

        $city = City::find($job->getOriginal('city'));
        if($city && $city->total_jobs != 0 ){
            $city->total_jobs = $city->total_jobs - 1;
            $city->save();
        }

        if( $job->job_status == 'active' ){
            $tojobs = City::find($job->city);
            if($tojobs){
                City::find($job->city)->update(["total_jobs" => $tojobs->total_jobs + 1]);
            }
//            dd($job->city);
        }
//
        $industry = Industry::find($job->getOriginal('job_industry'));
        if($industry && $industry->total_jobs != 0 ){
            $industry->total_jobs = $industry->total_jobs - 1;
            $industry->save();
        }
        if( $job->job_status == 'active' ) {
            $tojobs = Industry::find($job->job_industry);
            Industry::find($job->job_industry)->update(["total_jobs" => $tojobs->total_jobs + 1]);
        }

//        $stats = WebStat::first();
//
//        if($stats->total_jobs != 0 && $job->getOriginal('job_status') == 'active') {
//            $stats->total_jobs = $stats->total_jobs - 1;
//            $stats->save();
//        }

        $jobs = Job::where("job_status", 'active')->count();

//        dd($jobs);
        $stats = WebStat::first();
        $stats->total_jobs = $jobs;
        $stats->save();


        }


    }
}
