<?php

namespace App\Listeners;

use App\AdminSetting;
use App\City;
use App\Industry;
use App\Job;
use App\Recruiter;
use App\Skill;
use App\WebStat;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use \App\Events\JobSaving as JobSavingEvent;

class JobSaving
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(JobSavingEvent $event)
    {


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

        $stats = WebStat::first();
        if(!$stats){
            $stats = new WebStat();
        }


        if ($job->is_external == 1) {

//            $getJob = Job::find($job->id);
            $job->store_industry_external($job);
//            $job->store_city_external($job);
        } else {

            $jobs = Job::where("job_status", 'active')->where("recruiter_id", $job->recruiter_id)->count();

            $recruiter = Recruiter::find($job->recruiter_id);
            $recruiter->update(['total_jobs' => $jobs]);

            $jobs = Job::where("job_status", 'active')->where("city", $job->city)->count();
            City::find($job->city)->update(["total_jobs" => $jobs]);


            $jobs = Job::where("job_status", 'active')->where("job_industry", $job->job_industry)->count();
            Industry::find($job->job_industry)->update(["total_jobs" => $jobs]);

            if( $job->job_status == 'active' ){
                $stats->total_jobs = $stats->total_jobs + 1;
                $stats->save();
            }


        }




    }
}
