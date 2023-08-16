<?php

namespace App\Http\Controllers\Admin;

use App\ActivityLogs;
use App\AllJobsStats;
use App\CvSearch;
use App\EmailStat;
use App\Flag;
use App\Http\Controllers\Controller;
use App\IncomingRequest;
use App\Industry;
use App\Job;
use App\JobAlert;
use App\Order;
use App\Recruiter;
use App\Seeker;
use App\SeekerExperience;
use App\SeekerProject;
use App\Skills;
use App\TrackSeekerTemplates;
use App\WebStat;
use Carbon\Carbon;
use Dompdf\Exception;
use Illuminate\Support\Facades\DB;

class AdminHomeController extends Controller
{
    public function index() {


        $start = Carbon::now()->subWeek()->startOfWeek();
        $end = Carbon::now()->subWeek()->endOfWeek();

        $weekStartDate = Carbon::now()->startOfWeek();
        $weekEndDate = Carbon::now()->endOfWeek();

        if(request('dates')){
            $tdates = explode('-', request('dates'));
            if(count($tdates) > 1){

//                $start = Carbon::parse($tdates[0])->subWeek()->startOfWeek();
//                $end = Carbon::parse($tdates[1])->subWeek()->endOfWeek();

                $weekStartDate = Carbon::parse($tdates[0]);
                $weekEndDate = Carbon::parse($tdates[1]);

//                dd($weekStartDate, $weekEndDate);
            }
        }

        $lastWeekSeekers = Seeker::CountrySigned()->whereBetween('created_at', [$start, $end])->count();
        $lastWeekRecruiter = Recruiter::CountrySigned()->whereBetween('created_at', [$start, $end])->count();



//        dd( $start, $end, $weekStartDate, $weekEndDate );
//        $thisWeekSeekers_cvs = Seeker::whereBetween('created_at', [$weekStartDate, $weekEndDate])->where('profile_complete', '>=', 80)->count();

        $thisWeekSeekers = Seeker::CountrySigned()->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
        $thisWeekRecruiter = Recruiter::CountrySigned()->whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();

//        dd($thisWeekSeekers, $weekStartDate, $weekEndDate);

//        $thisWeekJob = 10;
        $thisWeekJob = Job::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
        $lastWeekJob = Job::whereBetween('created_at', [$start, $end])->count();
        $thisWeekOrder = Order::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();

//        dd($thisWeekJob);

//        $lastWeekJob = 20;
        $lastWeekOrder = Order::whereBetween('created_at', [$start, $end])->count();


        $sent_jobs = EmailStat::where('email_stats.created_at', '>', Carbon::now()->subDays(4))
                      ->leftJoin('job_alerts', 'email_stats.alert_id', '=', 'job_alerts.id')
                     ->select('job_alerts.email', DB::raw('count(*) as sent'))
                     ->groupBy("email_stats.alert_id")
                     ->orderBy('email_stats.id', 'DESC')
                     ->paginate(50);
//        dd( $sent_jobs );

        $thisWeekcvs = CvSearch::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
        $lastWeekcvs = CvSearch::whereBetween('created_at', [$start, $end])->count();


        $experienceSeeker = SeekerExperience::count();
        $projectsSeeker = SeekerProject::count();

        $seekers = Seeker::CountrySigned()->count();
        $recruiter = Recruiter::CountrySigned()->count();
        $jobs = Job::select("id","title","slug","views","job_status","is_external")
                    ->where('job_status', 'active')
                    ->limit(10)
                    ->get();
//        $job = Job::orderBy('views', 'desc')->where('job_status', 'active')->take(10)->get();
        $cvs = CvSearch::sum('counts');

        $cv = CvSearch::select(
            DB::raw('sum(counts) as `sums`'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
        ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
        ->orderBy("created_at", "desc")
        ->groupBy('months')
        ->get();

//        $cv = json_encode($cv);
        $cv_sums = json_encode($cv->pluck('sums'));
        $cv_months = json_encode($cv->pluck('months'));


//        $jobAlerts = DB::table('email_stats')
//                                ->select('alert_id', DB::raw('count(*) as total'))
//                                ->groupBy('alert_id')
//                                ->get();
        $jobAlerts = JobAlert::count();
        $thisWeekalerts = JobAlert::whereBetween('created_at', [$weekStartDate, $weekEndDate])->count();
        $lastWeekalerts = JobAlert::whereBetween('created_at', [$start, $end])->count();

//        dd($jobAlerts);
        $activity = ActivityLogs::where('activity_on', 'api_jobs')->orderBy('id', 'desc')->limit(40)->get();

        $orders = Order::count();

        $order = Order::select(
            DB::raw('sum(total_amount) as `sums`'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
        ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
        ->orderBy("created_at", "desc")
        ->groupBy('months')
        ->get();
//        ->pluck('sums')
        $orders_total = $order->pluck('sums');
        $orders_months = $order->pluck('months');
//        $order = json_encode($order);
//        dd($orders_months);
        $templates = TrackSeekerTemplates::select(
            DB::raw('sum(downloads) as `sums`'),
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
        )
            ->where("created_at", ">", \Carbon\Carbon::now()->subMonths(6))
            ->orderBy("created_at", "desc")
            ->groupBy('months')
            ->get();

//        $templates = json_encode($templates);
        $templates_total = json_encode($templates->pluck('sums'));
        $templates_months = json_encode($templates->pluck('months'));


        $all_stats = AllJobsStats::select("date as t", "jobs as y")->pluck("y", "t");
        $all_stats = json_encode($all_stats);
//        dd();
        $months = '';
        $webstat = WebStat::first();

        $seekerss = Seeker::CountrySigned()->where( 'created_at', '>', \Carbon\Carbon::now()->subDays(3))->get();
        $recruiterss = Recruiter::CountrySigned()->where( 'created_at', '>', \Carbon\Carbon::now()->subDays(3))->get();

        return view('admin.content', compact('weekStartDate','weekEndDate','seekerss','recruiterss','projectsSeeker','experienceSeeker','cv_sums','cv_months','thisWeekcvs','lastWeekcvs','cvs','seekers', 'recruiter', 'jobs',  'jobAlerts', 'activity', 'orders', 'lastWeekSeekers', 'thisWeekSeekers', 'thisWeekRecruiter', 'lastWeekRecruiter', 'thisWeekJob', 'lastWeekJob', 'thisWeekOrder', 'lastWeekOrder', 'all_stats', 'orders_total','orders_months','templates_total','templates_months','months','sent_jobs', 'webstat' , 'thisWeekalerts' , 'lastWeekalerts'));


    }

    public function clicks_job_post(){

        $clicks = IncomingRequest::latest()->get();

        return view('admin.clicks.post_job_page', compact('clicks'));

    }

    public function allStats() {


        $flags = Flag::all();
        foreach ($flags as $flag){
            $result[] = array("name" => trim($flag->name), "url" => trim($flag->url) );
        }
//        pluck('name','url')->toJson();

//        echo 'https://'.$flag->url.'/api/getStats?key=0900';

//        dd($result);
        $data['flags'] = $result;
        return view('admin.stats', $data);

    }







}
