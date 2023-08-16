<?php

namespace App\Http\Controllers\Api;

use App\Affiliate;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use App\Http\Resources\MedicalJobsResource;
use App\Industry;
use App\Job;
use App\JobAlert;
use App\Marketplace;
use App\Seeker;
use App\Skill;
use App\Traits\ApiResponse;
use App\WebStat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ApiController extends Controller
{

    use ApiResponse;

    public function jobs(Request $request)
    {

        $domain = request()->getHttpHost();
        $domain = str_replace(".fratres.net", "", $domain);


        $apiKey = null;
        if (!$request->apikey || $request->apikey == '') {
            return $this->error("API KEY not provided");
        } else {
            $market = Marketplace::where("api_key", $request->apikey)->where('status', 1)->first();
            if (!$market) {
                return $this->error("Invalid API KEY");
            }
            $apiKey = $market->api_key;
//            $market = Marketplace::first();
//            dd( $market );
        }


        $query_push = [];
        if (isset($_GET['salary-min'])) {
            $salary_min = $_GET['salary-min'];
            $salary_min_query = ' (salary_min >= ' . $salary_min . ')';
            array_push($query_push, $salary_min_query);
        }
        if (isset($_GET['salary-max'])) {
            $salary_max = $_GET['salary-max'];
            $salary_max_query = ' (salary_max <= ' . $salary_max . ')';
            array_push($query_push, $salary_max_query);
        }
        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $q_query = ' (title LIKE "%' . $q . '%")';
            array_push($query_push, $q_query);
        }


        $query = Job::query();

        if (isset($_GET['location'])) {
            $location = $_GET['location'];
            $cities = City::whereRaw(' name LIKE  "%' . $location . '%" ')->pluck('id')->toArray();
            if (count($cities) > 0) {
                $query->whereIn('city', $cities);
            }
        }

        if (count($query_push) > 0) {
            $query_push = implode(" AND ", $query_push);
            $query->whereRaw($query_push);
        }

        $jobs = $query->with('get_city')->select("id", "title", "city", "location_string", "slug", "description", "salary_min", "salary_max", "salary_schedule", "expiry_date")->where('job_status', 'active')->paginate(30);


//        return $jobs;

        $response = [];
        $response['current_page'] = $jobs->currentPage();
        $response['last_page'] = $jobs->lastPage();
        $response['per_page'] = $jobs->perPage();


        foreach ($jobs->items() as $key => $job) {
            $response['data'][$key]['title'] = $job->title;
            $response['data'][$key]['slug'] = 'https://marketplace.fratres.net/api/track?id=' . encrypt($job->id) . '---' . $job->id . '&apikey=' . $apiKey . '&c=' . $domain;
            $response['data'][$key]['description'] = $job->description;
            if ($job->location_string != null) {
                $response['data'][$key]['location'] = $job->location_string;
            } else {
                $cityy = null;
                if ($job->get_city != null) {
                    $cityy = $job->get_city->name;
                }
                $response['data'][$key]['location'] = $cityy;
            }

            $response['data'][$key]['salary_min'] = $job->salary_min;
            $response['data'][$key]['salary_max'] = $job->salary_max;
            $response['data'][$key]['salary_schedule'] = $job->salary_schedule;
            $response['data'][$key]['expiry_date'] = $job->expiry_date;
//            $response->$key = $job->$key;
        }
//        dd( $response );
//        die();
//        return $response;
//        return $response;
//        return new JobCollection($response);
        return $this->success("", $response);

    }

    public function detail(Request $request, $cookie, $id, $cid)
    {

        if (!$request->cookie('_fc')) {
            setcookie('_fc', $cookie, time() + (86400 * 30), "/"); // 86400 = 1 day
        } else {
            $cookie = $request->cookie('_fc');
        }

        $applied = FALSE;
        $job = Job::find($id);
        if ($job) {
//        dd($job);
            if ($job->is_external == 1) {
                $job->increment_views();
                $job->storeVisitor();
                return redirect()->away($job->slug);
            }

            if (Auth::guard('seeker')->check()) {
                $applicants_array = $job->applicants->pluck('seeker_id')->toArray();
                if ($applicants_array) {
                    if (in_array(seeker_logged('id'), $applicants_array)) {
                        $applied = TRUE;
                    }
                }
            }


            $skills = Skill::WhereIn("id", $job->skills->pluck('id')->toArray())->orderByRaw("Rand()")->get();

            if (count($skills) > 0) {
                $relatedskills = $skills[0];
                $relatedJobs = $relatedskills->jobs()->limit(5)->get();
            } else {
                $relatedJobs = FALSE;
            }

            $recruiterJobs = Job::isActive()->where('recruiter_id', $job->recruiter_id)->orderbyRaw('Rand()')->limit(3)->get();
            $recentJobs = Job::isActive()->orderByRaw('Rand()')->limit(3)->get();


            $job->increment_views();
            $job->storeVisitor();
            $cities = City::select('id', 'name')->get();
            $industries = Industry::all();
            $saved_jobs = Cookie::get('saved_jobs');
            $saved_jobs = explode(",", $saved_jobs);
            $stats = WebStat::first();

            return view('frontend.affiliate.job-detail', compact('job', 'relatedJobs', 'recruiterJobs', 'recentJobs', 'cities', 'industries', 'saved_jobs', 'applied', 'skills', 'stats', 'cookie', 'cid'));


        } else {
            abort(404);
        }


    }

    public function updateStats(Request $request)
    {


        $affiliate = Affiliate::where("cid", $request->cid)->first();
        if ($affiliate) {

//            dd($affiliate);

            $db = DB::connection('mysql_affiliate');

            $record = $db->table($affiliate->id . '_user_requests')->where("cookie", $request->cookie)->first();
//            dd($record);
            if ($record) {
//                dd( $request->all() );

//                $data = json_decode($record->mouse_movement);
                $data = $request->except(["cookie", "cid", "OS"]);
                $data['timespent'] = $request->timespent + $record->timespent;
                $data['clicks'] = $request->clicks + $record->clicks;
                $data['mouse_movement'] = $request->mouse_movement + $record->mouse_movement;

//                dd($data);
                $db->table($affiliate->id . '_user_requests')->where("cookie", $request->cookie)->update($data);

            }

        } else {
            return 'not found';
        }


    }


    public function index()
    {

        $stat = WebStat::first();
        return $stat->total_jobs;
    }

    public function medicalsjobs()
    {

        $medicaljobs = Job::whereRaw(" (category_string like '%health%' OR category_string like '%Veterinary%'
        OR category_string like '%Hospital%' OR category_string like '%Nursing%' OR title like
        '%Veterinary%' OR title like '%Hospital%' OR title like '%Nursing%' OR title like
        '%Medical%' OR title like '%Doctor%') AND ( imported_medical IS NULL )  ")
            ->groupBy("slug")->orderBy('id', 'desc')->where('job_status', 'active')->where('is_external',1)->limit(500)->get();

        return $medicaljobs;


    }

    public function update_products1($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["imported_medical" => 1]);

    }

    public function retailsjobs()
    {

        $medicaljobs = Job::whereRaw(" (category_string like '%Sales%' OR category_string like '%Store Manager%' OR category_string like '%Customer Service%' OR category_string like '%Product Manufacturing%'
        OR category_string like '%Retail Sales%' OR category_string like '%Retail Store%'
        OR category_string like '%Business Services%' OR category_string like '%Warehousing%' )
        AND ( imported_retail IS NULL )  ")
            ->groupBy("slug")->orderBy('id', 'desc')->where('job_status', 'active')->where('is_external',1)->limit(500)->get();

        return $medicaljobs;


    }

    public function update_products2($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["imported_retail" => 1]);

    }

    public function cityJobs()
    {

        $medicaljobs = Job::whereRaw(" (category_string like '%Accounting%' OR category_string like '%Bank%'
        OR category_string like '%Hotel%' OR category_string like '%Accountant%' OR category_string like '%Assistant%'
        OR category_string like '%Audit Senior%' OR category_string like '%Financial%' OR category_string like '%Customer Service%')
        AND ( imported_city IS NULL )  ")
            ->groupBy("slug")->orderBy('id', 'desc')->where('job_status', 'active')->where('is_external',1)->limit(500)->get();

        return $medicaljobs;


    }

    public function update_products3($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["imported_city" => 1]);

    }

    public function aeCityJobs()
    {

        $medicaljobs = Job::whereRaw(" (category_string like '%Accounting%' OR category_string like '%Bank%'
        OR category_string like '%Hotel%' OR category_string like '%Accountant%' OR category_string like '%Assistant%'
        OR category_string like '%Audit Senior%' OR category_string like '%Financial%' OR category_string like '%Customer Service%')
        AND ( imported_city IS NULL )  ")
            ->groupBy("slug")->orderBy('id', 'desc')->where('job_status', 'active')->where('is_external',1)->limit(500)->get();
        return $medicaljobs;


    }

    public function update_products4($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["imported_city" => 1]);

    }

    public function usCityJobs()
    {

        $medicaljobs = Job::whereRaw(" (category_string like '%Accounting%' OR category_string like '%Bank%'
        OR category_string like '%Hotel%' OR category_string like '%Accountant%' OR category_string like '%Assistant%'
        OR category_string like '%Audit Senior%' OR category_string like '%Financial%' OR category_string like '%Customer Service%')
        AND ( imported_city IS NULL )  ")
            ->groupBy("slug")->orderBy('id', 'desc')->where('job_status', 'active')->where('is_external',1)->limit(500)->get();
        return $medicaljobs;


    }

    public function update_products5($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["imported_city" => 1]);

    }

    public function sgCityJobs()
    {

        $medicaljobs = Job::whereRaw(" (category_string like '%Accounting%' OR category_string like '%Bank%'
        OR category_string like '%Hotel%' OR category_string like '%Accountant%' OR category_string like '%Assistant%'
        OR category_string like '%Audit Senior%' OR category_string like '%Financial%' OR category_string like '%Customer Service%')
        AND ( imported_city IS NULL )  ")
            ->groupBy("slug")->orderBy('id', 'desc')->where('job_status', 'active')->where('is_external',1)->limit(500)->get();
        return $medicaljobs;


    }

    public function update_products6($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["imported_city" => 1]);

    }

    public function wowJobs()
    {

        $medicaljobs = Job::limit(500)->where('job_status', 'active')->where('is_external',1)->get();

        return $medicaljobs;


    }

    public function update_products7($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["imported_wowjobs" => 1]);

    }

    public function pkWowJobs()
    {

        $medicaljobs = Job::limit(500)->where('job_status', 'active')->where('is_external',1)->get();

        return $medicaljobs;


    }

    public function update_products8($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["imported_wowjobs" => 1]);

    }

    public function security_jobs()
    {

        $securityJobs = Job::with('recruiter')->limit(500)->where('job_industry', 41)->where('job_status', 'active')->get();

        return $securityJobs;


    }

    public function update_products9($ids)
    {

        $ids = explode(",", $ids);
        Job::whereIn('id', $ids)->update(["import_security" => 1]);

    }


    public function createEmailAlertsFromMedicalJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }

    public function createEmailAlertsFromCityJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }

    public function createEmailAlertsFromaeCityJobsJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }

    public function createEmailAlertsFromsgCityJobsJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }

    public function createEmailAlertsFromusCityJobsJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }

    public function createEmailAlertsFromwowJobsJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }

    public function createEmailAlertsFrompkWowJobsJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }

    public function createEmailAlertsFromretailJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }

    public function createEmailAlertsFromSecurityJobs(Request $request)
    {
        $alert = new JobAlert();
        $alert->email = $request->user . $request->domain;
        $alert->random_id = Str::random(191);

        if ($alert) {
            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;
            $seeker = Seeker::where('email', $request->email)->first();
            if ($seeker) {
                $alert->is_seeker = 1;
            }
            $alert->save();
            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->user . $request->domain;
        }
    }


}
