<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seeker extends Authenticatable
{
    public function __construct(array $attributes = [])
    {
        if(env("APP_ENV") != 'local'){

        parent::__construct($attributes);
        $this->setConnection('mysql_accounts');
        }
    }

    use Notifiable;

    protected $fillable = [
        'original_id',
        'country_is',
        'profile_complete',
        'total_alerts',
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar',
        'postcode',
        'current_job_title',
        'current_company',
        'gender',
        'phone',
        'dob',
        'expected_salary',
        'experience_years',
        'available_job_type',
        'country',
        'city',
        'industries',
        'cv_resume',
        'relocate',
        'reg_step',
        'skills',
        'saved_jobs',
        'is_social_login',
        'social_login_id',
        'social_channel',
        'is_blocked',
        'email_verified_at',
        'confirm_email_random_id',
        'social_token',
        'remember_token',
        'martial_status',
        'degree_level',
        'career_level',
        'website_portfolio',
        'facebook_profile',
        'twitter_profile',
        'linkdin_profile',
        'github_profile',
        'hobbies',
        'languages',
        'seeking_job',
        'username',
        'is_upgraded',
        'expiry_upgrade',
        'stripe_customer_id',
        'country_signed',
        'ip_origin',
        'summary'
    ];


    /**
     * Accessor for Age.
     */
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    protected $hidden = [
//        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeCountrySigned($query) {
        return $query->where("country_signed", getsubDomain());
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = \Hash::make($value);
    }


    public function isOnline() {

        return Cache::has('seeker_is_online-' . $this->id);

    }

    public function industry(){
        return $this->belongsTo(Industry::class, 'industries');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'recruiter_id','id')->where('order_type', 'seeker_upgraded_profile');
    }

    public function skills() {
        return $this->belongsToMany(Skill::class);
    }

    public function applications(){
        return $this->hasMany(Applicant::class);
    }

    public function experience(){
        return $this->hasMany(SeekerExperience::class)->latest();
    }

    public function projects(){
        return $this->hasMany(SeekerProject::class)->latest();
    }

    public function certifications(){
        return $this->hasMany(SeekerCertification::class)->latest();
    }

    public function references(){
        return $this->hasMany(SeekerReference::class)->latest();
    }

    public function education(){
        return $this->hasMany(EducationSeeker::class)->latest();
    }
    public function job_alerts(){
        return $this->hasMany(JobAlert::class,'email','email')->latest();
    }



    public function profile_strength($inputs=FALSE){

        $strength = 0;
        $missing_inputs = array();

        if( $this->cv_resume != '' ){

            $increment = 10;
            $fields = array("first_name","email","phone","dob","avatar","expected_salary","available_job_type","cv_resume","gender", "city");


            foreach ($fields as $field){
                if($this->$field != ''){
                    $strength = $strength + $increment;
                }else{
                    array_push($missing_inputs, $field);
                }
            }

            $strength = round($strength);
            if($strength>100){
                $strength = 100;
            }

            $this->profile_complete = $strength;
            $this->save();

            if($inputs==TRUE){
                return $missing_inputs;
            }

        }else{


            $increment = 7.7;
            $fields = array("first_name","email","phone","dob","avatar","expected_salary","available_job_type","summary","languages");




            foreach ($fields as $field){
                if($this->$field != ''){
                    $strength = $strength + $increment;
                }else{
                    array_push($missing_inputs, $field);
                }
            }



            if( $this->experience()->count() > 0 ){
                $strength = $strength + $increment;
            }else{
                array_push($missing_inputs, "Experience");
            }
            if( $this->projects()->count() > 0 ){
                $strength = $strength + $increment;
            }else{
                array_push($missing_inputs, "Projects");
            }
            if( $this->education()->count() > 0 ){
                $strength = $strength + $increment;
            }else{
                array_push($missing_inputs, "Education");
            }
            if( $this->skills != null ){
                $strength = $strength + $increment;
            }else{
                array_push($missing_inputs, "Skills");
            }




            $strength = round($strength);
            if($strength>100){
                $strength = 100;
            }



            $this->profile_complete = $strength;
            $this->save();

            if($inputs==TRUE){
                return $missing_inputs;
            }

        }

    }

    public function getScoreAttribute(){


        $increment = 7.7;
        $strength = 0;

        $fields = array("first_name","email","phone","dob","avatar","expected_salary","available_job_type","summary","languages");

        foreach ($fields as $field) {
            if ($this->$field != '') {
                $strength = $strength + $increment;
            }
        }

        if( $this->experience()->count() > 0 ){
            $strength = $strength + $increment;
        }
        if( $this->projects()->count() > 0 ){
            $strength = $strength + $increment;
        }
        if( $this->education()->count() > 0 ){
            $strength = $strength + $increment;
        }
        if( $this->skills()->count() > 0 ){
            $strength = $strength + $increment;
        }

        $strength = round($strength);
        if($strength>100){
            $strength = 100;
        }


        echo $strength;


    }

    public function cv_download_inputs(){

        $profile = $this->profile_strength();
        $missing_inputs = array();

        if( !$this->experience()->count() > 0 ){
            array_push($missing_inputs, "Experience");
        }
        if( !$this->projects()->count() > 0 ){
            array_push($missing_inputs, "Projects");
        }
        if( !$this->education()->count() > 0 ){
            array_push($missing_inputs, "Education");
        }

        if( !$this->industry()->count() > 0 ){
            array_push($missing_inputs, "Industry");
        }

        if( !$this->summary != '' ){
            array_push($missing_inputs, "Summary");
        }
        if( !$this->avatar != '' ){
            array_push($missing_inputs, "Profile Picture");
        }







        return $missing_inputs;


    }


}
