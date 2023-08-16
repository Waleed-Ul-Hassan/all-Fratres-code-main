<?php

namespace App\Http\Controllers\Front;

use App\City;
use App\Industry;
use App\Job;
use App\Skill;
use App\WebStat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AffiliateController extends Controller
{

    public function index($id, $cookie){

        if( !request()->cookie('_fc') ){
            setcookie('_fc', $cookie, time() + (86400 * 30), "/"); // 86400 = 1 day
        }else{
            $cookie = request()->cookie('_fc');
        }

        $job = Job::find($id);

        $applied = FALSE;
        if(!$job){
            return abort(404);
        }


        if(Auth::guard('seeker')->check()) {
            $applicants_array = $job->applicants->pluck('seeker_id')->toArray();
            if ($applicants_array) {
                if(in_array(seeker_logged('id'), $applicants_array)){
                    $applied = TRUE;
                }
            }
        }

        $skills = Skill::WhereIn("id",$job->skills->pluck('id')->toArray())->orderByRaw("Rand()")->get();
        if(count($skills)>0){
            $relatedskills = $skills[0];
            $relatedJobs = $relatedskills->jobs()->limit(5)->get();
        }else{
            $relatedJobs = FALSE;
        }

        $recruiterJobs = Job::isActive()->where('recruiter_id', $job->recruiter_id)->orderbyRaw('Rand()')->limit(3)->get();
        $recentJobs = Job::isActive()->orderByRaw('Rand()')->limit(3)->get();


        $job->increment_views();
        $job->storeVisitor();
        $cities = City::select('id','name')->get();
        $industries = Industry::all();
        $saved_jobs = Cookie::get('saved_jobs');
        $saved_jobs = explode(",",$saved_jobs);
        $stats = WebStat::first();

        return view('frontend.affiliate.job-detail', compact('job','relatedJobs','recruiterJobs','recentJobs','cities','industries','saved_jobs','applied','skills','stats','cookie'));

    }
}
