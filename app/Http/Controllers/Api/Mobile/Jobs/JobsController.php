<?php

namespace App\Http\Controllers\Api\Mobile\Jobs;

use App\Applicant;
use App\City;
use App\Industry;
use App\Job;
use App\NotificationLogs;
use App\Recruiter;
use App\Seeker;
use App\Traits\ApiResponse;
use App\Traits\ExternalJobs;
use App\Traits\JobsImport\ApiJobs;
use App\UserSearches;
use App\ValidateTokens;
use App\WebStat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobsController extends Controller
{
    use ExternalJobs;
    use ApiResponse;
    use ApiJobs;
    private $activity_on = 'api_jobs';

    public function search(Request $request){

        try{
            $search_args = [];
            $distance = '';
            $query_array = [];
            $job = new Job();

            $recdb = (new Recruiter())->getConnection()->getDatabaseName();
            $jobdb = (new Job())->getConnection()->getDatabaseName();

            if ($request->location && $request->location != ''){

                $location = str_replace("-", " ", strtolower($request->location));
                $city = City::whereRaw("name LIKE '%".$location."%'")->select('name','lat','lon')->first();
                if( $city ){
                    $lat = floor($city->lat);
                    $lon = floor($city->lon);
                    if($request->distance && $request->distance != ''){
                        $city = DB::select("SELECT id, (3959 *
                    acos(cos(radians(".$lat.")) *
                        cos(radians(lat)) *
                        cos(radians(lon) -
                            radians(".$lon.")) +
                        sin(radians(".$lat.")) *
                        sin(radians(lat )))
                        ) AS distance from cities HAVING distance <= ".$request->distance);

                        $collection = collect($city);
                        $distance = $collection->pluck('id')->toArray();
                        $distance = implode(",", $distance);
                    }

                }

                $search_args = array_merge(array("location"=> $request->location), $search_args);
            }

            $query = DB::table($jobdb.'.jobs')
                ->leftJoin($jobdb.'.cities', $jobdb.'.jobs.city', '=', $jobdb.'.cities.id')
                ->leftJoin($recdb.'.recruiters', $jobdb.'.jobs.recruiter_id', '=', $recdb.'.recruiters.id')
                ->leftJoin($jobdb.'.industries', $jobdb.'.jobs.job_industry', '=', $jobdb.'.industries.id')
                ->select( $job->getSelectiveFields() )
                ->orderByRaw('IF(`is_external` <> 1, 0, 1) , `id` DESC, `job_website` ASC');

            if ($request->q && $request->q != ''){
                $q_string = " (jobs.title LIKE '".$request->q."%' ) ";

                $search_args = array_merge(array("q"=> $request->q), $search_args);
                array_push($query_array, $q_string);
            }

            $salary = '';
            if($request->salary_min && $request->salary_min != ''){
                $salary = $request->salary_min;
            }
            if($request->salary_max && $request->salary_max != ''){
                if( $request->salary_min != '' ){
                    $salary = $request->salary_min.'-'.$request->salary_max;
                }else{
                    $salary = '0-'.$request->salary_max;
                }
            }



            if ($salary && $salary != ''){
                $salary  = explode("-",$salary);
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

            if ($request->industry && $request->industry != ''){
                $industry_string = " (industries.industry_slug = '".$request->industry."') ";
                array_push($query_array,$industry_string);
            }

            if ($request->company && $request->company != ''){
                $company_string = " (recruiters.company_name = '".$request->company."') ";
                array_push($query_array,$company_string);
            }


            if ($request->location && $request->location != ''){
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

            if ($request->contract && $request->contract != ''){
                $contract_string = " (jobs.contract_type = '".$request->contract."') ";

                array_push($query_array,$contract_string);
            }

            if ($request->hours && $request->hours != ''){
                $time_string = " (jobs.time_available = '".$request->hours."') ";

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

            if( ip() == '39.53.180.137' ){
//            dd( $jobs );
            }


            $cities = City::select("city_slug","name", "total_jobs")->orderBy('total_jobs', 'DESC')->limit(12)->get();
            $industries = Industry::orderBy('total_jobs', 'DESC')->select("industry_slug", "name", "total_jobs")->limit(12)->get();

            $stats = WebStat::select('total_jobs','average_salary')->first();
            if(!$stats){
                WebStat::create(["total_jobs" => 0]);
                $stats = WebStat::first();
            }

            $saved_jobs = Cookie::get('saved_jobs');
            $saved_jobs = explode(",",$saved_jobs);
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

            $data['jobs'] = $jobs;
            $data['industries'] = $industries;
            $data['cities'] = $cities;
            $data['saved_jobs'] = $saved_jobs;
            $data['search_args'] = $search_args;
            $data['stats'] = $stats;
            $data['popular_searches'] = $popular_searches;
            $data['request'] = $request;
            $data['permanent'] = $permanent;
            $data['temporary'] = $temporary;
            $data['full_time'] = $full_time;
            $data['part_time'] = $part_time;
            $data['total'] = $total;
            $data['custom_page'] = $custom_page;
            $data['seo_key'] = $seo_key;

            return $this->success("Jobs", $data);
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }
    }

    public function detail(Request $request){

        try{
            $applied = FALSE;
            $slug = $request->slug;
            $job = Job::with('recruiter')->find($slug);
            if($job){

                $job->increment_views();
                $job->storeVisitor();

                if($job->is_external == 1){

                    $data['job'] = $job;
                    $data['is_external'] = 1;
                    return $this->success("Jobs", $data);

                }

                $authorization = $request->bearerToken();
                if($authorization){
                    $token = new ValidateTokens();
                    $seeker = $token->seeker($authorization);
                    if($seeker){
                        $request['seekerIs'] = $seeker;
                    }
                }

                if($request->seekerIs && $request->seekerIs != '') {
                    $applicants_array = $job->applicants->pluck('seeker_id')->toArray();
                    if ($applicants_array) {
                        if(in_array($request->seekerIs->id, $applicants_array)){
                            $applied = TRUE;
                        }
                    }
                }

                $recruiterJobs = Job::isActive()->where('recruiter_id', $job->recruiter_id)->orderbyRaw('Rand()')->limit(3)->get();

                $data['job'] = $job;
                $data['recruiterJobs'] = $recruiterJobs;
                $data['applied'] = $applied;

                return $this->success("Jobs", $data);

            }else{
                return $this->error("Job not found");

            }

        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }


    public function apply_job(Request $request){

       try{

           $job = Job::find($request->slug);
//        dd( $job );
           $authorization = $request->bearerToken();
           if($authorization){
               $token = new ValidateTokens();
               $seeker = $token->seeker($authorization);
               if($seeker){
                   $request['seekerIs'] = $seeker;
               }
           }

           if($job){

               if($request->seekerIs) {
//                   dd( $request->all() );

                   $seeker = Seeker::find($request->seekerIs->id);
                   if($seeker) {
                       $additionalFileName = '';
                       if ($request->hasFile('additional_docs')) {

                           $directory = public_path('/applicants/' . getDomainRoot());
                           if (!file_exists($directory)) {
                               $directory = File::makeDirectory($directory);
                           }
//                    dd('asda', $directory);

                           $time = time() . md5(time()) . Str::limit(10);
                           $additionalFileName = $time . '.' . $request->additional_docs->getClientOriginalExtension();

                           $request->additional_docs->move($directory, $additionalFileName);
                       }

                       Applicant::updateOrCreate([
                           'job_id' => $job->id,
                           'seeker_id' => $seeker->id,
                       ], [
                               'cover_letter' => $request->cover_letter,
                               'additional_docs' => $additionalFileName,
                           ]
                       );

                       NotificationLogs::create([
                           "notifier_id" => $job->recruiter_id,
                           "notifier_type" => 'recruiter',
                           "message" => 'New Candidate applied to your Job ' . $job->title,
                           "url" => "#",
                       ]);

                       $subject = "Applied Successfully";
                       $mesg = view('frontend.emails.seeker_job_apply', compact('seeker','job'))->render();
                       verify_email($seeker->email, $subject, $mesg, "", "noreply@fratres.net");

                       return $this->success("Applied Successfully");
                   }else{
                       return $this->error("User not Found");
                   }

               }else{


                   $validator = Validator::make($request->all(), [
                       'name' => 'required','email' => 'required|email','password' =>  ['required','confirmed','string','min:4','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],'cv_resume' => "required|mimes:pdf"
                   ]);

                   if($validator->fails()) {
                       $response = [];
                       $errors = $validator->errors();
                       foreach ($errors->all() as $key => $error){
                           $response['errors'][$key] = $error;
                       }
                       return $this->error("Validation failed", $response);
                   }else{

                       if ($request->has('cv_resume')) {
                           $time = time() . md5(time()) . Str::limit(10);
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
                               'email'=> $request->email,
                               'password'=>$request->password,
                               'cv_resume'=>$imageName,
                           ]);

//                    dd($user);

//                    dd('asdas');
                       $token = new ValidateTokens();
                       $validate = $token->accessToken("seeker", $user->id);

                       if(env('APP_SEND_EMAIL') == 'local') {
                           $subject = "Confirm Email";
                           $mesg = view('frontend.emails.seeker_confirm_signup', compact('seeker'))->render();
                           verify_email($user->email, $subject, $mesg, "", "noreply@fratres.net");
                       }


                       Applicant::updateOrCreate([
                           'job_id' => $job->id,
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


                       $subject = "Applied Successfully";
                       $mesg = view('frontend.emails.seeker_job_apply', compact('seeker','job'))->render();
                       verify_email($user->email, $subject, $mesg, "", "noreply@fratres.net");

                       $response['access_token'] = $validate;
                       $response['seeker'] = $user;

                       return $this->success("Congrats! You have successfull applied for the job, please complete your profile so you can attract more companies", $response);

                   }

               }

               $subject = "New Candidate Applied";
               $mesg = view('frontend.emails.recruiter_job_notify', compact('job'))->render();
               verify_email($job->recruiter->email, $subject, $mesg, "", "noreply@fratres.net");

           }else{
               return $this->error("Job not Found");
           }

       }catch (\Exception $exception){
           return $this->error($exception->getMessage());
       }

    }

    public function save_job(Request $request){

        $authorization = $request->bearerToken();
        if($authorization){
            $token = new ValidateTokens();
            $seeker = $token->seeker($authorization);
            if(!$seeker){
                return $this->loginRequired("Please Login to continue");
            }
            $request['seekerIs'] = $seeker;
        }

        $job_id = $request->id;
        if($request->seekerIs && $request->seekerIs->id != ''){
            $seeker = Seeker::find($request->seekerIs->id);
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

            $msg = 'Job was removed';
            if($response){
                $msg = 'Job Added';
            }

            $data['response'] = $msg;
            return $this->success('success', $data);

        }else{
            return $this->loginRequired('Please Login to continue');

        }



    }


    public function show_saved_jobs(Request $request){

        $authorization = $request->bearerToken();
        if($authorization){
            $token = new ValidateTokens();
            $seeker = $token->seeker($authorization);
            if(!$seeker){
                return $this->loginRequired("Please Login to continue");
            }
            $request['seekerIs'] = $seeker;
        }

        if($request->seekerIs && $request->seekerIs->id != ''){

            $seeker = Seeker::find($request->seekerIs->id);
            $ids = $seeker->saved_jobs;

            if($ids != '') {
                $ids_array = explode(",", $ids);
                $jobs = Job::isActive()->whereIn('jobs.id', $ids_array)
                    ->leftJoin('cities', 'jobs.city', '=', 'cities.id')
                    ->leftJoin('recruiters', 'jobs.recruiter_id', '=', 'recruiters.id')
                    ->select('jobs.id','cities.name','cities.total_jobs','jobs.slug','jobs.title','jobs.salary_schedule','jobs.description','jobs.salary_min','jobs.salary_max','jobs.created_at','recruiters.company_name','recruiters.company_logo','jobs.is_external','jobs.job_website','jobs.salary_string','jobs.location_string')
                    ->get();

                if(count($jobs)>0){

                    foreach ($jobs as $job){
                        if(!in_array($job->id, $ids_array)){
                            array_push($job->id, $ids_array);
                        }
                    }
                    if(count($ids_array) > 0){
                        $seeker->saved_jobs = implode(",", $ids_array);
                    }else{
                        $seeker->saved_jobs = null;
                    }
                    $seeker->save();
                    $data['jobs'] = $jobs;
                    return $this->success("Jobs", $data);

                }else{
                    $seeker->saved_jobs = null;
                    $seeker->save();
                    return $this->error("No Saved Jobs");
                }
            }else{
                return $this->error("No Saved Jobs");
            }
        }




    }


    public function delete_saved_job($id){

        $ids = Cookie::get('saved_jobs');

        if($ids != '') {
            $ids_array = explode(",", $ids);

//            dd($ids_array);

            $ids_array = array_diff($ids_array, [$id]);
            Cookie::queue(Cookie::make('saved_jobs', implode(",", $ids_array), 300000));

            return redirect()->back()->with(swal_alert_message("Congratulations","Job is removed from saved","Okay","success"));
        }
    }

}
