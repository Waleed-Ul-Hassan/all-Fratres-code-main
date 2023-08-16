<?php

namespace App\Http\Controllers\Recruiter;

use App\Applicant;
use App\Job;
use App\JobStat;
use App\Recruiter;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RecruiterStatsController extends Controller
{

    public function index(){
        $jobs = Job::where('job_status','active')->orWhere('job_status', 'paused')

                ->leftJoin('cities', 'jobs.city', '=', 'cities.id')
                ->get();

        return view('frontend.recruiter.stats.index', compact('jobs'));

    }

    public function applicants($id){

        $recdb = (new Recruiter())->getConnection()->getDatabaseName();
        $jobdb = (new Job())->getConnection()->getDatabaseName();


        $job = Job::where("unique_string", $id)->first();
        $jobs = Job::where('recruiter_id', recruiter_logged('id'))->get();



        if($job){
            $status = '';
            if( isset($_GET['status']) ){
                $status = $_GET['status'];
                switch ($status){
                    case 'awaiting':
                        $applicants = $job->application_awaiting('id');
                    break;
                    case 'reviewed':
                        $applicants = $job->application_reviewed('id')->orderBy('short_listed', 'ASC');
                    break;
                    case 'shortlist':
                        $applicants = $job->application_shortlisted('id');
                    break;
                    case 'rejected':
                        $applicants = $job->application_rejected('id');
                    break;


                }
            }else{
                $applicants = $job->applicants()->where('short_listed', '!=', 2)->orderBy('id', 'DESC')->orderBy('short_listed', 'ASC');
            }



            if( isset($_GET['orderBy']) && $_GET['orderBy'] != '' ){


                $order = $_GET['orderBy'];
                switch ($order){
                    case 'a-z':
                        $applicants = $applicants->leftjoin($recdb.'.seekers', $jobdb.'.applicants.seeker_id', $recdb.'.seekers.id')
                            ->select('seekers.first_name','applicants.*')->orderBy($recdb.'.seekers.first_name', 'asc');
                        break;
                    case 'z-a':
                        $applicants = $applicants->leftjoin($recdb.'.seekers', $jobdb.'.applicants.seeker_id', $recdb.'.seekers.id')
                            ->select('seekers.first_name','applicants.*')->orderBy($recdb.'.seekers.first_name', 'desc');
                        break;
                    case 'new':
                        $applicants = $applicants->orderBy('id', 'desc');
                    break;
                    case 'old':
                        $applicants = $applicants->orderBy('id', 'asc');
                    break;

                }

            }

//            dd($applicants);

            if(isset($_GET['applicant_id']) && $_GET['applicant_id'] != ''){
                $applicants = $applicants->where("id", $_GET['applicant_id'])->get();
            }else{
                $applicants = $applicants->get();
            }

            return view('frontend.recruiter.applicants.index', compact('applicants','job', 'jobs'));
        }

    }


    public function stats($unique_string){
        $job = Job::select('id','title','job_status','expiry_date','views','salary_min','salary_max','job_industry','city','salary_schedule','contract_type')->where('unique_string', $unique_string)->first();

       $stats = $job->stats()->whereRaw('ip_address IS NOT NULL')->get();

       if( $stats ){
           foreach ($stats as $stat){

                $browser = getBrowser();
                $getVisitor = getVisitor($stat->ip_address);
                $content_decode = json_decode($getVisitor['content']);

                if($content_decode->status == 'success'){
                    $stat->country = $content_decode->country;
                    $stat->browser = $browser['name'];
                    $stat->platform = $browser['platform'];
                    $stat->city = $content_decode->city;
                    $stat->lat = $content_decode->lat;
                    $stat->lon = $content_decode->lon;
                    $stat->timezone = $content_decode->timezone;
                    $stat->isp = $content_decode->isp;
                    $stat->region = $content_decode->region;
                    $stat->regionName = $content_decode->regionName;
                    $stat->countryCode = $content_decode->countryCode;
                    $stat->zip = $content_decode->zip;
                    $stat->save();
                }

           }
       }

    $results = $job->stats()->whereBetween('updated_at', [Carbon::now()->subDays(6)->format('Y-m-d')." 00:00:00", Carbon::now()->format('Y-m-d')." 23:59:59"])
        ->groupBy('date')
        ->orderBy('date')
        ->get([
            DB::raw('DATE_FORMAT(updated_at, "%Y-%m-%d") as date'),
            DB::raw('count(*) as total')
        ])
        ->keyBy('date')
        ->map(function ($item) {
            $item->date = Carbon::parse($item->date);
            return $item;
        });


    $period = new \DatePeriod(Carbon::now()->subDays(6), CarbonInterval::day(), Carbon::now()->addDay());


    $graph = array_map(function ($datePeriod) use ($results) {
        $date = $datePeriod->format('Y-m-d');

        return $results->has($date) ? $results->get($date)->total : 0;

    }, iterator_to_array($period));


    $browser_data = $job->stats()->selectRaw('browser, count(`browser`) as total ')->groupBy('browser')->get();
    $browser_name = $browser_data->pluck('browser')->toArray();
    $browser_views = $browser_data->pluck('total')->toArray();


        $browsers = "'".implode("','", $browser_name)."'";

        return view('frontend.recruiter.stats.stats', compact('job', 'graph', 'browsers','browser_views'));

    }






}
