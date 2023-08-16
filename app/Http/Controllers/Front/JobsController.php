<?php

namespace App\Http\Controllers\Front;


use App\Applicant;
use App\City;
use App\Industry;
use App\Job;
use App\NotificationLogs;
use App\Recruiter;
use App\Seeker;
use App\Skill;
use App\Traits\ExternalJobs;
use App\Traits\JobsImport\ApiJobs;
//use App\Traits\JobsImport\WhatJobs;
use App\UserSearches;
use App\WebStat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobsController extends Controller
{
    use ExternalJobs;
    use ApiJobs;
    private $activity_on = 'api_jobs';


    public function search(){

//        dd($_SERVER['REMOTE_ADDR']);
        $search_args = [];
        $distance = '';
        $query_array = [];
        $job = new Job();

        $recdb = (new Recruiter())->getConnection()->getDatabaseName();
        $jobdb = (new Job())->getConnection()->getDatabaseName();


        if (isset($_GET['location']) && $_GET['location'] != ''){

            $location = str_replace("-", " ", strtolower($_GET['location']));
            $city = City::whereRaw("name LIKE '%".$location."%'")->select('name','lat','lon')->first();
            if( $city ){
                $lat = floor($city->lat);
                $lon = floor($city->lon);
                if(isset($_GET['distance']) && $_GET['distance'] != ''){
                    $city = DB::select("SELECT id, (3959 *
                    acos(cos(radians(".$lat.")) *
                        cos(radians(lat)) *
                        cos(radians(lon) -
                            radians(".$lon.")) +
                        sin(radians(".$lat.")) *
                        sin(radians(lat )))
                        ) AS distance from cities HAVING distance <= ".$_GET['distance']);

                    $collection = collect($city);
                    $distance = $collection->pluck('id')->toArray();
                    $distance = implode(",", $distance);
                }

            }

            $search_args = array_merge(array("location"=> $_GET['location']), $search_args);
        }



        $query = DB::table($jobdb.'.jobs')
            ->leftJoin($jobdb.'.cities', $jobdb.'.jobs.city', '=', $jobdb.'.cities.id')
            ->leftJoin($recdb.'.recruiters', $jobdb.'.jobs.recruiter_id', '=', $recdb.'.recruiters.id')
            ->leftJoin($jobdb.'.industries', $jobdb.'.jobs.job_industry', '=', $jobdb.'.industries.id')
            ->select( $job->getSelectiveFields() )
            ->orderByRaw('IF(`is_external` <> 1, 0, 1) , `id` DESC, `job_website` ASC');

        if (isset($_GET['q']) && $_GET['q'] != ''){
            $q_string = " (jobs.title LIKE '".$_GET['q']."%' ) ";

            $search_args = array_merge(array("q"=>$_GET['q']), $search_args);
            array_push($query_array, $q_string);
        }

        if(isset($_GET['salary-min']) && $_GET['salary-min'] != ''){
            $_GET['salary'] = $_GET['salary-min'];
        }
        if(isset($_GET['salary-max']) && $_GET['salary-max'] != ''){
            if( $_GET['salary-min'] != '' ){
                $_GET['salary'] = $_GET['salary-min'].'-'.$_GET['salary-max'];
            }else{
                $_GET['salary'] = '0-'.$_GET['salary-max'];
            }
        }



        if (isset($_GET['salary']) && $_GET['salary'] != ''){
            $salary  = explode("-",$_GET['salary']);
            if(count($salary) == 2){
                $min_salary = if_isset($salary,0);
                $max_salary = if_isset($salary,1);
            }else{
                $min_salary = 0;
                $max_salary = if_isset($salary,0);
            }
            $salary_string = " (jobs.salary_min >= ".$min_salary." AND jobs.salary_max <= ".$max_salary.") OR (jobs.salary_string LIKE '%".$min_salary."%' OR jobs.salary_string LIKE '%".$max_salary."%') ";
            array_push($query_array,$salary_string);
        }

        if (isset($_GET['industry']) && $_GET['industry'] != ''){
            $industry_string = " (industries.industry_slug = '".$_GET['industry']."') ";
            array_push($query_array,$industry_string);
        }

        if (isset($_GET['company']) && $_GET['company'] != ''){
            $company_string = " (recruiters.company_name = '".$_GET['company']."') ";
            array_push($query_array,$company_string);
        }


        if (isset($_GET['location']) && $_GET['location'] != ''){
            if(!empty($distance)){
//                or LOWER(jobs.location_string) LIKE LOWER('".$_GET['location']."%')
                $location_string = " (cities.id IN (".$distance.") ) ";

            }else{
//                OR LOWER(jobs.location_string) LIKE LOWER('%".$location."%')
//                dd($location);
                $location_string = " LOWER(cities.name) LIKE LOWER('%".$location."%') OR LOWER(jobs.location_string) LIKE LOWER('%".$location."%')";

            }

            array_push($query_array,$location_string);
        }

        if (isset($_GET['contract']) && $_GET['contract'] != ''){
            $contract_string = " (jobs.contract_type = '".$_GET['contract']."') ";

            array_push($query_array,$contract_string);
        }

        if (isset($_GET['hours']) && $_GET['hours'] != ''){
            $time_string = " (jobs.time_available = '".$_GET['hours']."') ";

            array_push($query_array,$time_string);
        }

        if(count($query_array) > 0){
             $query->whereRaw( "( ". implode("AND", $query_array) ." ) AND (jobs.job_status = 'active') " );
        }else{
             $query->whereRaw( " (jobs.job_status = 'active' ) " );
        }


        if(count($search_args) > 0){
            UserSearches::save_search();
        }

        $request = Request::capture();

        try{
//            $total = $query->count();
            $jobs = $query->paginate(20);

        }catch (\Exception $exception){
            dd($exception->getMessage());
        }




        $cities = City::select("city_slug","name", "total_jobs")->orderBy('total_jobs', 'DESC')->limit(12)->get();
        $industries = Industry::orderBy('total_jobs', 'DESC')->select("industry_slug", "name", "total_jobs")->limit(12)->get();

        $stats = WebStat::select('total_jobs','average_salary')->first();
        if(!$stats){
            WebStat::create(["total_jobs" => 0]);
            $stats = WebStat::first();
        }

        $saved_jobs = null;
        $seeker = Seeker::find(seeker_logged('id'));
        $saved_jobs = Cookie::get('saved_jobs').',';;
        if($seeker){
            $saved_jobs .= $seeker->saved_jobs;
        }
        $saved_jobs = array_filter(explode(",",$saved_jobs));
        if( ip() == '39.53.173.119' ){
//            dd( $saved_jobs );
        }
        $popular_searches = UserSearches::where('search_keyword','!=','')->where('hits','>',10)->orderBy('hits', 'DESC')->limit(10)->groupBy('search_keyword')->select('search_keyword')->get();

        $available_jobs = Job::select("contract_type","time_available")->where('job_status','active')->where('contract_type','!=', null)->limit(500)->get();
        $permanent = 0;
        $temporary = 0;
        $full_time = 0;
        $part_time = 0;
        foreach ($available_jobs as $available_job){
            if($available_job->contract_type == 'permanent'){
                $permanent++;
            }
            if($available_job->contract_type == 'temporary'){
                $temporary++;
            }
            if($available_job->time_available == 'full_time'){
                $full_time++;
            }
            if($available_job->time_available == 'part_time'){
                $part_time++;
            }


        }

        $total = $stats->total_jobs;

        $custom_page = false;
        $seo_key = "";

//        $this->cookieSearch();

        return view('frontend.home.search', compact('jobs','industries','cities','saved_jobs','search_args','stats','popular_searches','request','permanent','temporary','full_time','part_time','total', 'custom_page','seo_key'));
    }

    public function cookieSearch(){

        $saved_search = null;
        $all_params = request()->all();
        $all_params = array_filter($all_params);

        if($all_params){

            foreach ($all_params as $key => $all_param){
                $saved_search .= $key.'='.$all_param.'&';
            }

            $saved_q = Cookie::get('c_search');
            $saved_search = $saved_q.'--@--'.$saved_search;
            Cookie::queue(Cookie::make('c_search', $saved_search, 300000));
        }

        $saved_q = explode('--@--', $saved_q);
        $saved_q = array_filter($saved_q);
        $saved_key = array_rand($saved_q);

        if( ip() == '39.53.92.253' ){

            if($saved_key){
                $filter_records = $saved_q[$saved_key];
                $filter_records = explode("&", $filter_records);
                $filter_records = array_filter($filter_records);
                if( $filter_records ){
                    foreach ($filter_records as $value){
                        $qq = explode("=", $value);
                        if(count($qq) > 1){
                            $param = $qq[0];
                            $val = $qq[1];


                            $search_args = [];
                            $distance = '';
                            $query_array = [];
                            $job = new Job();

                            if ($param == 'location'){

                                $location = str_replace("-", " ", strtolower($val));
                                $city = City::whereRaw("name LIKE '%".$location."%'")->select('name','lat','lon')->first();
                                if( $city ){
                                    $lat = floor($city->lat);
                                    $lon = floor($city->lon);
                                    if(isset($_GET['distance']) && $_GET['distance'] != ''){
                                        $city = DB::select("SELECT id, (3959 *
                                                acos(cos(radians(".$lat.")) *
                                                    cos(radians(lat)) *
                                                    cos(radians(lon) -
                                                        radians(".$lon.")) +
                                                    sin(radians(".$lat.")) *
                                                    sin(radians(lat )))
                                         ) AS distance from cities HAVING distance <= ".$_GET['distance']);

                                        $collection = collect($city);
                                        $distance = $collection->pluck('id')->toArray();
                                        $distance = implode(",", $distance);
                                    }

                                }

                                $search_args = array_merge(array("location"=> $_GET['location']), $search_args);
                            }

                            $query = DB::table('jobs')
                                ->leftJoin('cities', 'jobs.city', '=', 'cities.id')
                                ->leftJoin('recruiters', 'jobs.recruiter_id', '=', 'recruiters.id')
                                ->leftJoin('industries', 'jobs.job_industry', '=', 'industries.id')
                                ->select( $job->getSelectiveFields() )
                                ->orderByRaw('IF(`is_external` <> 1, 0, 1) , `id` DESC, `job_website` ASC');

                            if ($param == 'q'){
                                $q_string = " (jobs.title LIKE '".$value."%' ) ";

                                $search_args = array_merge(array("q"=> $value ), $search_args);
                                array_push($query_array, $q_string);
                            }
                            $salary_min = 0;
                            if($param == 'salary-min' && $param != ''){
                                $salary_min = $val;
                            }
                            if($param == 'salary-max' && $param != ''){
                                $salary = $salary_min.'-'.$val;
                            }else{
                                $salary = '0-'.$salary_min;
                            }



                            if ($param == 'salary' && $param != ''){
                                $salary  = explode("-",$val);
                                if(count($salary) == 2){
                                    $min_salary = if_isset($salary,0);
                                    $max_salary = if_isset($salary,1);
                                }else{
                                    $min_salary = 0;
                                    $max_salary = if_isset($salary,0);
                                }
                                $salary_string = " (jobs.salary_min >= ".$min_salary." AND jobs.salary_max <= ".$max_salary.") OR (jobs.salary_string LIKE '%".$min_salary."%' OR jobs.salary_string LIKE '%".$max_salary."%') ";
                                array_push($query_array,$salary_string);
                            }

                            if (isset($_GET['industry']) && $_GET['industry'] != ''){
                                $industry_string = " (industries.industry_slug = '".$_GET['industry']."') ";
                                array_push($query_array,$industry_string);
                            }

                            if (isset($_GET['company']) && $_GET['company'] != ''){
                                $company_string = " (recruiters.company_name = '".$_GET['company']."') ";
                                array_push($query_array,$company_string);
                            }


                            if (isset($_GET['location']) && $_GET['location'] != ''){
                                if(!empty($distance)){
//                or LOWER(jobs.location_string) LIKE LOWER('".$_GET['location']."%')
                                    $location_string = " (cities.id IN (".$distance.") ) ";

                                }else{
//                OR LOWER(jobs.location_string) LIKE LOWER('%".$location."%')
//                dd($location);
                                    $location_string = " LOWER(cities.name) LIKE LOWER('%".$location."%') OR LOWER(jobs.location_string) LIKE LOWER('%".$location."%')";

                                }

                                array_push($query_array,$location_string);
                            }

                            if (isset($_GET['contract']) && $_GET['contract'] != ''){
                                $contract_string = " (jobs.contract_type = '".$_GET['contract']."') ";

                                array_push($query_array,$contract_string);
                            }

                            if (isset($_GET['hours']) && $_GET['hours'] != ''){
                                $time_string = " (jobs.time_available = '".$_GET['hours']."') ";

                                array_push($query_array,$time_string);
                            }

                            if(count($query_array) > 0){
                                $query->whereRaw( "( ". implode("AND", $query_array) ." ) AND (jobs.job_status = 'active' ) " );
                            }else{
                                $query->whereRaw( " (jobs.job_status = 'active' ) " );
                            }


                            if(count($search_args) > 0){
                                UserSearches::save_search();
                            }

                            $request = Request::capture();

                            try{
//            $total = $query->count();
                                $jobs = $query->paginate(20);

                            }catch (\Exception $exception){
                                dd($exception->getMessage());
                            }


                        }
                    }
                }
            }


        }

    }


    public function detail($slug){

//        City::save_lat_long();
//        die();
        $applied = FALSE;
        if(isset($_GET['isExternal'])){

            $job = Job::find(decrypt($slug));
            if($job){

                $job->increment_views();
                $job->storeVisitor();
                return redirect()->away($job->slug);

            }else{
                return abort(404);
            }

        }

        $saved_jobs = '';
        $job = Job::where('slug', $slug)->first();
//        dd($job);
        if(!$job){
            abort(404);
        }
        if(Auth::guard('seeker')->check()) {
            $applicants_array = $job->applicants->pluck('seeker_id')->toArray();
            if ($applicants_array) {
                if(in_array(seeker_logged('id'), $applicants_array)){
                    $applied = TRUE;
                }
            }
            $seeker = Seeker::find(seeker_logged('id'));
            $saved_jobs = $seeker->saved_jobs.',';
        }
        $saved_jobs .= Cookie::get('saved_jobs');
        $saved_jobs = array_filter(explode(",",$saved_jobs));

        // $skills = Skill::WhereIn("id",$job->skills->pluck('id')->toArray())->orderByRaw("Rand()")->get();
//        if(ip() == '39.53.102.165'){
            if($job->job_industry != null){
//
                $industry = Industry::find($job->job_industry);
                 $relatedJobs = $industry->jobs()->limit(3)->get();
            }else{
                $relatedJobs = FALSE;
            }
//            dd( $industry, $relatedJobs );
//        }



        $recruiterJobs = Job::isActive()->where('recruiter_id', $job->recruiter_id)->orderbyRaw('Rand()')->limit(3)->get();
        $recentJobs = Job::isActive()->orderByRaw('Rand()')->limit(3)->get();


        $job->increment_views();
        $job->storeVisitor();
        $cities = City::select('id','name')->get();
        $industries = Industry::all();

        $stats = WebStat::first();

        return view('frontend.home.job-detail', compact('job','relatedJobs','recruiterJobs','recentJobs','cities','industries','saved_jobs','applied','stats'));
    }


    public function apply_job(Request $request){


        $job = Job::find(decrypt($request->boj_value));

        if($job){

            if(Auth::guard('seeker')->check()) {



                $seeker = Seeker::find(seeker_logged('id'));
                $additionalFileName = '';
                if ($request->hasFile('additional_docs')) {


                    $directory = public_path('/applicants/' . getDomainRoot());
                    if (!file_exists($directory)) {
                        $directory = File::makeDirectory($directory);
                    }


                    $time = time() . md5(time()) . Str::limit(10);
                    $additionalFileName = $time . '.' . $request->additional_docs->getClientOriginalExtension();
                    $request->additional_docs->move($directory, $additionalFileName);
                }

                Applicant::updateOrCreate([
                    'job_id' => decrypt($request->boj_value),
                    'seeker_id' => $seeker->id,
                ],[
                    'cover_letter' => $request->cover_letter,
                    'additional_docs' => $additionalFileName,
                    ]
                );

                NotificationLogs::create([
                    "notifier_id" => $job->recruiter_id,
                    "notifier_type" => 'recruiter',
                    "message" => 'New Candidate applied to your Job '.$job->title,
                    "url" => "#",
                ]);

                if( Config::get('mail.APP_SEND_EMAIL') != 'local') {
                    $subject = "Applied Successfully";
                    $mesg = view('frontend.emails.seeker_job_apply', compact('seeker','job'))->render();
                    verify_email($seeker->email, $subject, $mesg, "", "noreply@fratres.net");
                }

            }else{


                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' =>  [
                        'required',
                        'confirmed',
                        'string',
                        'min:4',             // must be at least 10 characters in length
                        'regex:/[a-z]/',      // must contain at least one lowercase letter
                        'regex:/[A-Z]/',      // must contain at least one uppercase letter
                        'regex:/[0-9]/',      // must contain at least one digit
                        'regex:/[@$!%*#?&]/', // must contain a special character
                    ],
                    'cv_resume' => "required|mimes:pdf|max:10000"
                ]);

                if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()->all()]);
                }else{

                    if ($request->has('cv_resume')) {
                        $time = time() . md5(time()) . \Illuminate\Support\Str::limit(10);
                        $imageName = $time . '-' . $request->cv_resume->getClientOriginalName() . '.' . $request->cv_resume->getClientOriginalExtension();
                        $request->cv_resume->move(public_path('seekers/cvs/'.getDomainRoot()), $imageName);
                    }

                    $seeker = new Seeker();
                    $user = $seeker::updateOrCreate(
                        [
                            'email' => $request->email
                        ],
                        [
                        'first_name'=>$request->name,
                        'password'=>$request->password,
                        'cv_resume'=>$imageName,
                    ]);

                    Auth::guard('seeker')->attempt(['email' => $user->email, 'password' => $request->password]);

                    if(env('APP_SEND_EMAIL') == 'local') {
                        $subject = "Confirm Email";
                        $mesg = view('frontend.emails.seeker_confirm_signup', compact('seeker'))->render();
                        verify_email($user->email, $subject, $mesg, "", "noreply@fratres.net");
                    }


                    Applicant::updateOrCreate([
                        'job_id' => decrypt($request->boj_value),
                        'seeker_id' => $user->id,
                    ],[
                            'cover_letter' => $request->cover_letter,
                        ]
                    );

                    NotificationLogs::create([
                        "notifier_id" => $job->recruiter_id,
                        "notifier_type" => 'recruiter',
                        "message" => 'New Candidate applied to your Job '.$job->title,
                        "url" => "#",
                    ]);


                    if( Config::get('mail.APP_SEND_EMAIL') != 'local') {
                        $subject = "Applied Successfully";
                        $mesg = view('frontend.emails.seeker_job_apply', compact('seeker','job'))->render();
                        verify_email($user->email, $subject, $mesg, "", "noreply@fratres.net");
                    }

                    return response()->json(['success'=>'Congrats! You have successfull applied for the job, please complete your profile so you can attract more companies']);
                }

            }

            if( Config::get('mail.APP_SEND_EMAIL') != 'local') {
                $subject = "New Candidate Applied";
                $mesg = view('frontend.emails.recruiter_job_notify', compact('job'))->render();
                verify_email($job->recruiter->email, $subject, $mesg, "", "noreply@fratres.net");
            }

        }

    }

    public function save_job(){

        $job_id = Input::get('job_id');
        $response = FALSE;
        $cookie_jobs = Cookie::get('saved_jobs');
        if($cookie_jobs != ''){
            $ids_array = explode(",",$cookie_jobs);
            if(in_array($job_id,$ids_array)){
                $ids_array = array_diff($ids_array, array($job_id));
            }else{
                array_push($ids_array, $job_id);
                $response = TRUE;
            }
            Cookie::queue(Cookie::make('saved_jobs', implode(",", $ids_array), 300000));
        }else{
            Cookie::queue(Cookie::make('saved_jobs', $job_id, 300000));
            $response = TRUE;
        }

        $seeker = Seeker::find(seeker_logged('id'));
        if($seeker){
//            $ids = $cookie_jobs;
            $ids = $seeker->saved_jobs;

            $response = FALSE;

            if($seeker->saved_jobs != ''){
                $ids_array = explode(",",$ids);
                if(in_array($job_id,$ids_array)){
                    $ids_array = array_diff($ids_array, array($job_id));
                }else{
                    array_push($ids_array, $job_id);
                    $response = TRUE;
                }
                $seeker->saved_jobs = implode(",", $ids_array);
//                Cookie::queue(Cookie::make('saved_jobs', implode(",", $ids_array), 300000));
            }else{
                $seeker->saved_jobs = $job_id;
//                Cookie::queue(Cookie::make('saved_jobs', $job_id, 300000));
                $response = TRUE;
            }
            $seeker->save();

        }

        if($response){
            return 'added';
        }else{
            return 'removed';
        }

    }


    public function show_saved_jobs(){

        $cjob = new Job();
        $ids_array = $cjob->cookieJobs();

//        $seeker = Seeker::find(seeker_logged('id'));
//        $ids = Cookie::get('saved_jobs');
//        if($ids != '') {
//            $ids = $ids.',';
//        }
//        if($seeker){
//            $ids .= $seeker->saved_jobs;
//        }

        $recdb = (new Recruiter())->getConnection()->getDatabaseName();
        $jobdb = (new Job())->getConnection()->getDatabaseName();

//        dd($ids);

        if($ids_array) {
//            $ids_array = array_filter(explode(",", $ids));

            $jobs = Job::isActive()->whereIn($jobdb.'.jobs.id', $ids_array)
                ->leftJoin($jobdb.'.cities', $jobdb.'.jobs.city', '=', $jobdb.'.cities.id')
                ->leftJoin($recdb.'.recruiters', $jobdb.'.jobs.recruiter_id', '=', $recdb.'.recruiters.id')
                ->select($jobdb.'.jobs.id',$jobdb.'.cities.name',$jobdb.'.cities.total_jobs',$jobdb.'.jobs.slug',$jobdb.'.jobs.title',$jobdb.'.jobs.salary_schedule',$jobdb.'.jobs.description',$jobdb.'.jobs.salary_min',$jobdb.'.jobs.salary_max',$jobdb.'.jobs.created_at',$recdb.'.recruiters.company_name',$recdb.'.recruiters.company_logo',$jobdb.'.jobs.is_external',$jobdb.'.jobs.job_website',$jobdb.'.jobs.salary_string',$jobdb.'.jobs.location_string')
                ->get();

            return view('frontend.home.show-saved-jobs', compact('jobs'));

        }else{


            return redirect('search')->with(swal_alert_message_error("You have not saved any job"));

        }




    }


    public function delete_saved_job($id){

//        $ids = Cookie::get('saved_jobs');
        $seeker = Seeker::find(seeker_logged('id'));
        if($seeker){
            $ids = $seeker->saved_jobs;
            $ids_array = explode(",", $ids);
            $ids_array = array_diff($ids_array, [$id]);
            $seeker->saved_jobs = implode(",", $ids_array);
            $seeker->save();
        }

        $ids = Cookie::get('saved_jobs');
        if($ids != '') {
            $ids_array = explode(",", $ids);
            $ids_array = array_diff($ids_array, [$id]);
            Cookie::queue(Cookie::make('saved_jobs', implode(",", $ids_array), 300000));
        }
        return redirect()->back()->with(swal_alert_message("Congratulations","Job is removed from saved","Okay","success"));
    }

    public function check_jobs(){


        pre($this->WhatJobs(), 1);
    }


    public function jobs_seo($keyword){

        $industry = false;
        $location = false;
        $query_array = [];
        $search_args = [];
        $seo_key = "";

        if(hasWord("in-", $keyword)){
            $location = true;
            $location_str = str_replace("in-", "", $keyword);
            $location_str = str_replace("-", " ", strtolower($location_str));
            $seo_key = $location_str."_location";
        }else{
            $industry = true;
            $seo_key  = $keyword."_industry";
        }

//        dd($location);
        $recdb = (new Recruiter())->getConnection()->getDatabaseName();
        $jobdb = (new Job())->getConnection()->getDatabaseName();

        $job = new Job();

        $query = DB::table($jobdb.'.jobs')
            ->leftJoin($jobdb.'.cities', $jobdb.'.jobs.city', '=', $jobdb.'.cities.id')
            ->leftJoin($recdb.'.recruiters', $jobdb.'.jobs.recruiter_id', '=', $recdb.'.recruiters.id')
            ->leftJoin($jobdb.'.industries', $jobdb.'.jobs.job_industry', '=', $jobdb.'.industries.id')
            ->select( $job->getSelectiveFields() );
//            ->orderByRaw('IF(`is_external` <> 1, 1, 0), RAND()');

        if($industry){

            $industry_string = " (industries.industry_slug = '".$keyword."') ";
            $search_args = array_merge(array("industry"=> $industry), $search_args);
            array_push($query_array,$industry_string);
        }

        if($location){
//            dd($location);
//            OR LOWER(jobs.location_string) LIKE LOWER('".$location_str."%')
            $location_string = " LOWER(cities.name) LIKE LOWER('%".$location_str."%') OR LOWER(jobs.location_string) LIKE LOWER('%".$location_str."%')";
//            $location_string = " cities.name LIKE LOWER('".$location_str."%')  ";
            $search_args = array_merge(array("location"=> $location_str), $search_args);
            array_push($query_array,$location_string);
        }




        if(count($query_array) > 0){
            $query->whereRaw( "( ". implode("AND", $query_array) ." ) AND (jobs.job_status = 'active') " );
        }else{
            $query->whereRaw( " (jobs.job_status = 'active') " );
        }

//        dd( $query->toSql() );


        $jobs = $query->simplePaginate(20);

        $request = Request::capture();
        $cities = City::orderBy('total_jobs', 'DESC')->select("city_slug","name", "total_jobs")->paginate(12);
        $industries = Industry::orderBy('total_jobs', 'DESC')->select("industry_slug", "name", "total_jobs")->paginate(12);

        $stats = WebStat::select('total_jobs','average_salary')->first();
        if(!$stats){
            WebStat::create(["total_jobs" => 0]);
            $stats = WebStat::first();
        }

        $saved_jobs = Cookie::get('saved_jobs');
        $saved_jobs = explode(",",$saved_jobs);
        $popular_searches = UserSearches::where('search_keyword','!=','')->orderBy('hits', 'DESC')
                            ->limit(10)->select('search_keyword')
                            ->groupBy('search_keyword')
                            ->get();

        $available_jobs = Job::select("contract_type","time_available")
                            ->where('job_status','active')->limit(1000)->get();
        $permanent = 0;
        $temporary = 0;
        $full_time = 0;
        $part_time = 0;
        foreach ($available_jobs as $available_job){
            if($available_job->contract_type == 'permanent'){
                $permanent++;
            }
            if($available_job->contract_type == 'temporary'){
                $temporary++;
            }
            if($available_job->time_available == 'full_time'){
                $full_time++;
            }
            if($available_job->time_available == 'part_time'){
                $part_time++;
            }


        }

        $total = WebStat::first();
        $total = $total->total_jobs;
        $custom_page = true;

//        dd($seo_key);

        return view('frontend.home.search', compact('jobs','industries','cities','saved_jobs','search_args','stats','popular_searches','request','permanent','temporary','full_time','part_time','total', 'custom_page','seo_key'));

    }

    public function jobs_at($keyword){

        $query_array = [];
        $search_args = [];
        $seo_key = "";


        $company = $keyword;
        $seo_key = $company."_company";

        $recdb = (new Recruiter())->getConnection()->getDatabaseName();
        $jobdb = (new Job())->getConnection()->getDatabaseName();
        $job = new Job();

        $query = DB::table($jobdb.'.jobs')
            ->leftJoin($jobdb.'.cities', $jobdb.'.jobs.city', '=', $jobdb.'.cities.id')
            ->leftJoin($recdb.'.recruiters', $jobdb.'.jobs.recruiter_id', '=', $recdb.'.recruiters.id')
            ->leftJoin($jobdb.'.industries', $jobdb.'.jobs.job_industry', '=', $jobdb.'.industries.id')
            ->select( $job->getSelectiveFields() )
            ->orderByRaw('IF(`is_external` <> 1, 1, 0), RAND()');


        $company_string = " (recruiters.company_name = '".$keyword."') ";
        $search_args = array_merge(array("recruiters"=> $company_string), $search_args);
        array_push($query_array,$company_string);



        if(count($query_array) > 0){
            $query->whereRaw( "( ". implode("AND", $query_array) ." ) AND (jobs.job_status = 'active') " );
        }else{
            $query->whereRaw( " (jobs.job_status = 'active') " );
        }



        $jobs = $query->paginate(20);

        $request = Request::capture();
        $cities = City::orderBy('total_jobs', 'DESC')->select("city_slug","name", "total_jobs")->paginate(12);
        $industries = Industry::orderBy('total_jobs', 'DESC')->select("industry_slug", "name", "total_jobs")->paginate(12);

        $stats = WebStat::select('total_jobs','average_salary')->first();
        if(!$stats){
            WebStat::create(["total_jobs" => 0]);
            $stats = WebStat::first();
        }

        $saved_jobs = Cookie::get('saved_jobs');
        $saved_jobs = explode(",",$saved_jobs);
        $popular_searches = UserSearches::where('search_keyword','!=','')
                            ->orderBy('hits', 'DESC')->limit(10)
                            ->groupBy('search_keyword')
                            ->select('search_keyword')->get();

        $available_jobs = Job::select("contract_type","time_available")->where('job_status','active')->limit(1000)->get();
        $permanent = 0;
        $temporary = 0;
        $full_time = 0;
        $part_time = 0;
        foreach ($available_jobs as $available_job){
            if($available_job->contract_type == 'permanent'){
                $permanent++;
            }
            if($available_job->contract_type == 'temporary'){
                $temporary++;
            }
            if($available_job->time_available == 'full_time'){
                $full_time++;
            }
            if($available_job->time_available == 'part_time'){
                $part_time++;
            }


        }

        $total = WebStat::first();
        $total = $total->total_jobs;
        $custom_page = true;

//        dd($seo_key);

        return view('frontend.home.search', compact('jobs','industries','cities','saved_jobs','search_args','stats','popular_searches','request','permanent','temporary','full_time','part_time','total', 'custom_page','seo_key'));

    }

    public function getJobs(){



        $medicaljobs = file_get_contents('http://securityjobs.org.uk/api/list/jobs');
        $medicaljobs = json_decode($medicaljobs);



        $imported_products = array();
        foreach($medicaljobs as $medicaljobss){


            $job = new Job();

//            $job->job_id = $medicaljobss->id;
            $job->recruiter_id = $medicaljobss->recruiter_id;
            $job->job_industry = $medicaljobss->job_industry;
            $job->title = $medicaljobss->title;
            $job->slug = $medicaljobss->slug;
            $job->description = $medicaljobss->description;
            $job->city = $medicaljobss->city;
            $job->contract_type = $medicaljobss->contract_type;
            $job->time_available = $medicaljobss->time_available;
            $job->salary_min = $medicaljobss->salary_min;
            $job->salary_max = $medicaljobss->salary_max;
            $job->salary_schedule = $medicaljobss->salary_schedule;
            $job->is_payment_done = $medicaljobss->is_payment_done;
            $job->unique_string = $medicaljobss->unique_string;
            $job->views = $medicaljobss->views;
            $job->has_coupon = $medicaljobss->has_coupon;
            $job->job_status = $medicaljobss->job_status;
            $job->job_reject_reason = $medicaljobss->job_reject_reason;
            $job->expiry_date = $medicaljobss->expiry_date;
            $job->created_at = $medicaljobss->created_at;
            $job->updated_at = $medicaljobss->updated_at;
            $job->postcode_string = $medicaljobss->postcode_string;
            $job->logo_string = $medicaljobss->logo_string;
            $job->snippet = $medicaljobss->snippet;
            $job->age_days = $medicaljobss->age_days;
            $job->location_string = $medicaljobss->location_string;
            $job->salary_string = $medicaljobss->salary_string;
            $job->company = $medicaljobss->company;
            $job->addition_params = $medicaljobss->addition_params;
            $job->job_id_string = $medicaljobss->job_id_string;
            $job->is_external = 1;
            if ($medicaljobss->job_website != null) {
                $job->job_website = $medicaljobss->job_website;
            }else{
                $job->job_website = $medicaljobss->recruiter->company_logo;
            }
            $job->category_string = $medicaljobss->category_string;
            $job->is_securiy_job = 1;

            $job->save();


            $imported_products[] = $medicaljobss->id;
        }

        $stats = WebStat::first();
        $jobs = Job::where("job_status", 'active')->count();
        $stats->total_jobs = $jobs;
        $stats->save();


        die();
//        $count =


    }


}
