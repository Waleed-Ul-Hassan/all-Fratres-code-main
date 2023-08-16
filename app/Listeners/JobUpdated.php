<?php

namespace App\Listeners;

use App\City;
use App\Industry;
use App\Job;
use App\Recruiter;
use App\WebStat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\Events\JobUpdated as JobUpdatedEvent;

class JobUpdated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(JobUpdatedEvent $event)
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

//        if( $job->city != '' ){
//            $jobs = Job::where("job_status", 'active')->where("city", $job->city)->count();
//            $city = City::find($job->city);
//            if($city){
//                $city->total_jobs = $jobs;
//                $city->save();
//            }
//
//        }
//
//        if( $job->job_industry != '' ){
//
//            $jobs = Job::where("job_status", 'active')->where("job_industry", $job->job_industry)->count();
//
//            $industry = Industry::find($job->job_industry);
//            $industry->total_jobs = $jobs;
//            $industry->save();
//
//        }

        if ($job->is_external != 1) {

            $jobs = Job::where("job_status", 'active')->where("recruiter_id", $job->recruiter_id)->count();
//            dd($jobs);
            $recruiter = Recruiter::find($job->recruiter_id);
            if( $recruiter ){
                $recruiter->update(['total_jobs' => $jobs]);
            }

        }



//        if( $job->job_status == 'active' ){

//        }


    }
}
