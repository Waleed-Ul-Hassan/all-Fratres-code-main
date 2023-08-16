<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Recruiter extends Authenticatable
{
    use SoftDeletes;

    public function __construct(array $attributes = [])
    {
        if(env("APP_ENV") != 'local'){
        parent::__construct($attributes);
        $this->setConnection('mysql_accounts');
        }
    }

    protected $fillable = [
        "original_id",
        "country_is",
        "total_jobs",
        "parent",
        "job_credits",
        "billing_details",
        "company_name",
        "company_slug",
        "company_url",
        "email",
        "password",
        "company_logo",
        "company_size",
        "creator_name",
        "creator_position",
        "phone",
        "country",
        "city",
        "industry",
        "company_description",
        "is_social_login",
        "social_login_id",
        "social_channel",
        "is_blocked",
        "email_verified_at",
        "confirm_email_random_id",
        "social_token",
        "remember_token",
        "stripe_customer_id",
        "cv_purchased_validity",
        "deleted_at",
        "country_signed",
        "ip_origin",
    ];


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


    public function setPasswordAttribute($value) {
        $this->attributes['password'] = \Hash::make($value);
    }

    public function isOnline() {

        return Cache::has('recruiter_is_online-' . $this->id);

    }


    public function scopeCountrySigned($query) {
        return $query->where("country_signed", getsubDomain());
    }

    public function ratings() {
        return $this->hasMany(CompanyReview::class, "company_id");
    }

    public function companySlug() {
        if($this->company_slug == null){
            $this->company_slug = $this->createSlug($this->company_name, $this->cname, $this->id);
            $this->save();
        }
        return $this->company_slug;
    }

    public function Activejobs() {
        return $this->hasMany(Job::class)->where('job_status', 'active');
    }

    public function jobs() {
        return $this->hasMany(Job::class);
    }

    public function cities() {
        return $this->hasOne(City::class, 'id', 'city');
    }

    public function get_industry() {
        return $this->hasOne(Industry::class, 'id', 'industry');
    }



    public function orders() {
        return $this->hasMany(Order::class)->where('order_type', 'single_job_credit')->Orwhere('order_type', 'cvs_purchased')->Orwhere('order_type', 'package_purchase');
    }


    public function reset_validity_cvs(){
        $valid_till = $this->cv_purchased_validity;

        if($valid_till != null &&  $valid_till < date("Y-m-d")){
            $this->cv_purchased_validity = null;
            $this->save();
        }

    }



    public function downloaded_cvs(){
        return $this->hasMany(RecruiterDownload::class);
    }

    public static function todays_downloads($order_id){
       return RecruiterDownload::where('order_id',$order_id)
                           ->whereRaw('DATE(`created_at`) = CURDATE()')
                            ->count();
    }

    public static function seekers_downloaded($order_id){
       return RecruiterDownload::where('order_id',$order_id);
    }

    public function cv_searches(){

        $stat = CvSearch::where("created_at", date("Y-m-d"))->first();
        if(!$stat){
            $stat = new CvSearch();
        }

        $stat->counts = $stat->counts + 1;
        $stat->save();
    }


    public function getRelatedSlugs($slug, $id = 0)
    {
        return Recruiter::select('company_slug')->where('company_slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function createSlug($title,$city, $id = 0)
    {
        // Normalize the title
        $title = Str::slug($title);
        $city = Str::slug($city);
        $slug = $city.'-'.$title;

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('company_slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.time();
            if (! $allSlugs->contains('company_slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }



}
