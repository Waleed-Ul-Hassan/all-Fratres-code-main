<?php

namespace App\Providers;

use App\AdminSetting;
use App\Flag;
use App\Job;
use App\Recruiter;
use App\Seeker;
use App\Seo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Traits\DatabaseSwitch;

class AppServiceProvider extends ServiceProvider
{
    use DatabaseSwitch;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {




    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

//        abort(401);

        $this->switch_db();
        $this->switch_analytics_id();
//        Config::set('app.debug', true);
//        dd( 'dasd' );

        $domain = request()->getHttpHost();
        $domain = str_replace(".fratres.net", "", $domain);



        Schema::defaultStringLength(191);

//        try{
//            if(!Seo::first()){
//                Seo::create(array("homepage_meta_key	"=>1));
//            }
//        }
//        catch(\Exception $e){
//
//            dd( $e->getMessage() );
//        }
//
//
//
        try{
            $settings = AdminSetting::first();
        }
        catch(\Exception $e){
            dd( $e->getMessage() );
        }

//        $seekerss = Seeker::where( 'created_at', '>', \Carbon\Carbon::now()->subDays(3))->get();
//        $recruiterss = Recruiter::where( 'created_at', '>', \Carbon\Carbon::now()->subDays(3))->get();
        $current_flag = Flag::where("name", $settings->country_name)->first();
//        $jobsss = Job::where( 'created_at', '>', \Carbon\Carbon::now()->subDays(3))->get();
//        dd( $current_flag );

        $paid = true;
        if($settings->website_is_free == 1){
            $paid = false;
        }

        View::share('settings', $settings);
        View::share('flags', Flag::orderBy('name', 'ASC')->get());
//        View::share('seo', Seo::first());

        View::share('current_flag', $current_flag->flag);
        View::share('isPaid', $paid);

//        if( $domain == 'kr' ){
//
//        }else{
//            View::share('current_flag', $current_flag->flag);
//        }
//        View::share('seekerss',$seekerss);
//        View::share('recruiterss', $recruiterss);
//        View::share('jobsss', $jobsss);

//        Auth::loginUsingId();


    }
}
