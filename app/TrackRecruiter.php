<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class   TrackRecruiter extends Model
{
    public $isIp = '';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection('mysql');
        
        $this->isIp = '39.53.135.473';
        $this->recruiter_id = null;
        if(Auth::guard('recruiter')->check()){
            $this->recruiter_id = Auth::guard('recruiter')->user()->id;
        }
    }


    protected $fillable = ["at_login_page","signed_up_at","logged_in_at","at_create_job_page","at_preview_job_page","at_billing_page","at_payment_page","time_spent","ip","recruiter_id","is_social" ];



    public function atloginPage(){
        if(ip() == $this->isIp) {
            if( request()->is('recruiter/login') ){
                TrackRecruiter::updateOrCreate(
                    [ "recruiter_id" => $this->recruiter_id, "ip" => ip()], ["at_login_page" => Carbon::now(), "recruiter_id" => $this->recruiter_id, "ip" => ip()]);
            }
        }

    }

    public function loginPage(){
        if(ip() == $this->isIp) {
            TrackRecruiter::updateOrCreate(
                ["ip" => ip()], ["logged_in_at" => Carbon::now(), "recruiter_id" => $this->recruiter_id, "ip" => ip()]);
        }
    }



    public function signedup($social = FALSE){

        if(ip() == $this->isIp){
            $isSocial = 0;
            if($social){ $isSocial = 1; }
            TrackRecruiter::updateOrCreate(
                [ "ip" => ip()],["signed_up_at" => Carbon::now(), "recruiter_id" => $this->recruiter_id, "ip" => ip(), "is_social" => $isSocial]);
        }
    }

    public function postJobPage(){

        if( request()->is('recruiter/job_post') ) {
            TrackRecruiter::updateOrCreate(
                ["recruiter_id" => $this->recruiter_id, "ip" => ip()], ["at_create_job_page" => Carbon::now(), "recruiter_id" => $this->recruiter_id, "ip" => ip()]);
        }

    }

    public function previewJobPage(){
        if( request()->is('recruiter/job-preview/*') ) {
            TrackRecruiter::updateOrCreate(
                ["recruiter_id" => $this->recruiter_id, "ip" => ip()], ["at_preview_job_page" => Carbon::now(), "recruiter_id" => $this->recruiter_id, "ip" => ip()]);
        }
    }

    public function billingJobPage(){
        if( request()->is('recruiter/job-billing/*') ) {
            TrackRecruiter::updateOrCreate(
                ["recruiter_id" => $this->recruiter_id, "ip" => ip()], ["at_billing_page" => Carbon::now(), "recruiter_id" => $this->recruiter_id, "ip" => ip()]);
        }
    }

    public function paymentJobPage(){
        if( request()->is('recruiter/job-post/pay/*') ) {
//            dd( $this->recruiter_id );
            TrackRecruiter::updateOrCreate(
                ["recruiter_id" => $this->recruiter_id,"ip" => ip()], ["at_payment_page" => Carbon::now(), "recruiter_id" => $this->recruiter_id, "ip" => ip()]);
        }
    }





    public function trackActivities(){
        if(ip() == $this->isIp) {
            $this->postJobPage();
            $this->previewJobPage();
            $this->billingJobPage();
            $this->paymentJobPage();
        }
    }

}
