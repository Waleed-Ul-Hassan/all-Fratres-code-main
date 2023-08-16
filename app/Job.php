<?php

namespace App;

use App\Events\JobSaving;
use App\Events\JobUpdated;
use App\Events\JobUpdating;
use App\Traits\GenericModelFunctions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Job extends Model
{

    use GenericModelFunctions;

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        "recruiter_id",
        "title",
        "slug",
        "city",
        "job_industry",
        "contract_type",
        "time_available",
        "salary_min",
        "salary_max",
        "salary_schedule",
        "description",
        "unique_string",
        "job_status",
        "views",
        "expiry_date",
        "postcode_string",
        "logo_string",
        "snippet",
        "age_days",
        "location_string",
        "salary_string",
        "company",
        "addition_params",
        "job_id_string",
        "job_website",
        "is_external",
        "category_string",
        "created_at",
        "imported_medical",
        "imported_retail",
        "imported_city",
        "imported_wowjobs",
        "ip_origin",
    ];

    protected $dispatchesEvents = [
        'created' => JobSaving::class,
        'saving' => JobUpdating::class,
        'updated' => JobUpdated::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'expiry_date',
    ];

    public $jobStatus = [
      'active','expired','paused','closed'
    ];

    public function recruiter(){
        return $this->belongsTo(Recruiter::class);
    }

    public function get_city(){
        return $this->belongsTo(City::class,"city","id");
    }

    public function get_industry(){
        return $this->belongsTo(Industry::class,"job_industry","id");
    }

    public function scopeIsActive(){
        return $this->where('job_status', 'active');
    }

    public function scopeisPending(){
        return $this->where('job_status', 'pending');
    }

    public function scopeisDraft(){
        return $this->where('job_status', 'draft');
    }

    public function scopeisExpired(){
        return $this->where('job_status', 'expired');
    }

    public static function countJobs($status){
        return Job::where('job_status', $status)->where('recruiter_id', recruiter_logged('id'))->count();
    }

    public static function cookieJobs(){
        $cd = [];
        $ids = Cookie::get('saved_jobs');
        if($ids != '') {
            $ids = $ids.',';
        }
        if(auth('seeker')->user()){
            $seeker = Seeker::find(seeker_logged('id'));
            $ids .= $seeker->saved_jobs;
        }
        $ids_array = array_filter(explode(",",$ids));
        if($ids_array){
            $jobs = Job::whereIn("id", $ids_array)->pluck('id');
            if($jobs){
                $cookies = Cookie::get('saved_jobs');
                $cookies = explode(",", $cookies);
                foreach ($cookies as $cookie){
                    if(in_array($cookie, $cookies)){
                        $cd[] = $cookie;
                    }
                }
                $cd = implode(",", $cd);
                Cookie::queue(Cookie::make('saved_jobs', $cd, 300000));
            }
            return $ids_array;
        }

        return [];
    }



    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function stats()
    {
        return $this->hasMany(JobStat::class);
    }



    public static function count_jobs()
    {
        return Job::where('recruiter_id', recruiter_logged('id'))->count();
    }

    public function skills(){
        return $this->belongsToMany(Skill::class);
    }

    public function skills_multiple(){
        return $this->hasMany(Skill::class);
    }



    public function increment_views(){
        return $this->update(['views' => $this->views +1]);
    }

    public function storeVisitor(){

            $job_id = $this->id;
            $stats = $this->store_stats($job_id);
            $stats->increment_views();
            return $stats;

    }

    public function applications($job_id='job_id')
    {
        return $this->hasMany(Applicant::class, 'job_id', $job_id);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }

    public function application_awaiting($job_id='job_id'){
        return $this->hasMany(Applicant::class, 'job_id', $job_id)->where("viewed_at", null);
    }

    public function application_rejected($job_id='job_id'){
        return $this->hasMany(Applicant::class, 'job_id', $job_id)->where("short_listed", 2);
    }



    public function application_reviewed($job_id='job_id'){
        return $this->hasMany(Applicant::class, 'job_id', $job_id)->where("viewed_at","!=", null);
    }

    public function application_shortlisted($job_id='job_id'){
        return $this->hasMany(Applicant::class, 'job_id', $job_id)->where("short_listed", 1);
    }

//
    public function getSelectiveFields(){
        return [ 'jobs.id','jobs.slug','jobs.title','jobs.salary_schedule','jobs.description','jobs.salary_min','salary_max','jobs.is_external','jobs.location_string','jobs.salary_string','jobs.company','jobs.job_website','jobs.recruiter_id','jobs.category_string','jobs.job_industry','jobs.job_status','jobs.addition_params','cities.name','cities.total_jobs','cities.lat','cities.lon','recruiters.company_name','recruiters.company_logo','industries.name as industry_name','industries.industry_slug' ];
    }


    public function store_industry_external($job){

        if($job->category_string != '' ){

            $industry = Industry::whereRaw(" name LIKE '%".$job->category_string."%'")->first();
            if(!is_null($industry)){

                $total_jobs = $industry->total_jobs + 1;
                Industry::find($industry->id)->update(["total_jobs" => $total_jobs]);

                $job->job_industry = $industry->id;
                $job->save();

            }else{

                Industry::create(["name" => $job->category_string, "industry_slug" => str_slug($job->category_string) , "total_jobs" => 1]);

            }
        }

    }

    public function store_city_external($job){

        if($job->location_string != '' ){

            $location_string = str_replace("UK","", $job->location_string);
            $location_string = str_replace(",","", $location_string);
            $location_string = trim($location_string);

            $city = City::whereRaw(" name LIKE '%".$location_string."%'")->first();

            if(!is_null($city)){

                $total_jobs = $city->total_jobs + 1;
                City::find($city->id)->update(["total_jobs" => $total_jobs]);

                $job->city = $city->id;
                $job->save();

            }else{

                City::create(["name" => $location_string, "city_slug" => str_slug($location_string) , "total_jobs" => 1]);


            }
        }

    }





    public function reset_database(){

//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        DB::table('cities')->update(array('total_jobs' => 0));
//
//        DB::table('skills')->update(array('total_jobs' => 0));
//        DB::table('industries')->update(array('total_jobs' => 0));
//
//        DB::table('jobs')->truncate();
//        DB::table('activity_logs')->truncate();
//        DB::table('advertisements')->truncate();
//        DB::table('api_jobs_pagings')->truncate();
//        DB::table('collect_newsletters')->truncate();
//        DB::table('contact_us')->truncate();
//        DB::table('coupons')->truncate();
//        DB::table('education_seekers')->truncate();
//        DB::table('job_alerts')->truncate();
//        DB::table('job_alert_skill')->truncate();
//        DB::table('job_skill')->truncate();
//        DB::table('job_stats')->truncate();
//        DB::table('notification_logs')->truncate();
//        DB::table('orders')->truncate();
//        DB::table('packages')->truncate();
//        DB::table('package_features')->truncate();
//        DB::table('recruiter_downloads')->truncate();
//        DB::table('seekers')->truncate();
//        DB::table('applicants')->truncate();
//        DB::table('seeker_certifications')->truncate();
//        DB::table('seeker_experiences')->truncate();
//        DB::table('seeker_projects')->truncate();
//        DB::table('seeker_references')->truncate();
//        DB::table('seeker_skill')->truncate();
//        DB::table('track_seeker_templates')->truncate();
//        DB::table('user_searches')->truncate();
//        DB::table('web_stats')->truncate();
//        DB::table('all_jobs_stats')->truncate();
//
//        DB::table('recruiters')->truncate();
//
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }




    public function getRelatedSlugs($slug, $id = 0)
    {
        return Job::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function createSlug($title,$city, $id = 0)
    {
        // Normalize the title
        $title = Str::slug($title);
        $city = Str::slug($city);
        $slug = $title.'-'.$city;

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.time();
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public function time_available(){
        if($this->time_available=='full_time'){
            return "Full Time";
        }else{
            return "Part Time";
        }

    }



}
