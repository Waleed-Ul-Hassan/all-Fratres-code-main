<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiJobsPaging extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }
    protected $fillable = [
        'jobs_from',
        'current_page',
        'total_pages',
    ];

    public static function whatJobs(){
        return ApiJobsPaging::where('jobs_from', 'what_jobs')->first();
    }

    public static function zip_recruiter(){
        return ApiJobsPaging::where('jobs_from', 'zip_recruiter')->first();
    }
    public static function adzuna(){
        return ApiJobsPaging::where('jobs_from', 'adzuna_jobs')->first();
    }

    public static function career_jet(){
        return ApiJobsPaging::where('jobs_from', 'career_jet')->first();
    }
    public static function jobto_me(){
        return ApiJobsPaging::where('jobs_from', 'jobto_me')->first();
    }





}
