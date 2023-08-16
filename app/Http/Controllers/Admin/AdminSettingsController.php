<?php

namespace App\Http\Controllers\Admin;


use App\AdminSetting;
use App\Flag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Image;

class AdminSettingsController extends Controller
{
    public function index() {

        $settings = AdminSetting::first();
        $flags = Flag::all();
        if(empty($settings)){
            AdminSetting::create(['public_logo'=>null]);
        }

//        dd($settings->appSettings("job_title_color", "#ffffff"));
//        dd($settings->constants['theme_color']);

//        $data = flags_subdomains();
//        $countries = Arr::pluck($data, 'url','name');
//        foreach ($countries as $country){
//            $country = str_replace(".fratres.net","", $country);
//            echo $country = strtoupper($country) . '<br>';
//        }
//        pre(Arr::pluck($data, 'url','name'),1);
//        foreach ($data as $key => $value){
//            $new = Flag::create($value);
//        }
//die();

        return view('admin.settings.index', compact('settings','flags'));
    }

    public function settings(Request $request) {

//        pre($this->getJobsSettings($request),1);
//        dd( $request->app_colors );

        $setting = AdminSetting::first();
        $path = (asset('logo/') . $setting->public_logo);


        if ($request->hasFile('public_logo')) {

            if (File::exists($path)) {
                File::delete($path);
            }


            $ext = $request->file('public_logo')->clientExtension();
            \Intervention\Image\Facades\Image::make($request->file('public_logo')->getRealPath())->save('logo/logo-uploaded.'.$ext);
            $public_logo = 'logo-uploaded.'.$ext;
            $setting->public_logo = $public_logo;
        }

        $url_country = $request->country.'.fratres.net';
        $get_country_data = Flag::where('url', $url_country)->first();


        $setting->website_title = $request->website_title;
        $setting->app_settings = json_encode($request->app_colors);
        $setting->google_translator = $request->google_translator;
        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->addrees = $request->addrees;
        $setting->about = $request->about;
        $setting->country_code = $request->country;
        if($get_country_data){
            $setting->country_name = $get_country_data->name;
        }
        $setting->currency = $request->currency;
        $setting->enable_language = $request->enable_language;
        $setting->language_code = $request->language_code;
        $setting->symbol = $request->symbol;
        $setting->single_job_price = $request->single_job_price;
        $setting->single_job_expiry_days = $request->single_job_expiry_days;
        $setting->google_api_key = $request->google_api_key;
        $setting->google_analytics = $request->google_analytics;
        $setting->android = $request->android;
        $setting->apple = $request->apple;
        $setting->facebook = $request->facebook;
        $setting->linkdin = $request->linkdin;
        $setting->twitter = $request->twitter;
        $setting->youtube = $request->youtube;
        $setting->pinterest = $request->pinterest;
        $setting->tumbler = $request->tumbler;
        $setting->instgram = $request->instgram;
        $setting->paypal_key = $request->paypal_key;
        $setting->paypal_secret = $request->paypal_secret;
        $setting->stripe_key = $request->stripe_key;
        $setting->google_adsense = $request->google_adsense;
        $setting->tax_unit = $request->tax_unit;
        $setting->tax = $request->tax;
        $setting->recruiter_cv_purchase_days = $request->recruiter_cv_purchase_days;
        $setting->recruiter_cv_purchase_price = $request->recruiter_cv_purchase_price;
        $setting->daily_limit_cv_download = $request->daily_limit_cv_download;
        $setting->seeker_upgrade_price = $request->seeker_upgrade_price;
        $setting->website_is_free = $request->website_is_free;

        $setting->external_jobs_apis = $this->getJobsSettings($request);




        $setting->save();

        return redirect('admin/settings')->with('message', 'Updated Successfully');
    }

    public function getJobsSettings($request){

        $data = array(
            "what_job_api" => return_zero($request->what_job_api, $request->whatjobs_api_key),
            "whatjobs_api_key" => $request->whatjobs_api_key,
            "zip_recruiter_api" => return_zero($request->zip_recruiter_api, $request->zip_recruiter_api_key),
            "zip_recruiter_api_key" => $request->zip_recruiter_api_key,
            "adzuna_api" => return_zero($request->adzuna_api, $request->adzuna_app_id, $request->adzuna_app_key),
            "adzuna_app_id" => $request->adzuna_app_id,
            "adzuna_app_key" => $request->adzuna_app_key,
            "jobtome_api" => return_zero($request->jobtome_api, $request->jobtome_api_key),
            "jobtome_api_key" => $request->jobtome_api_key,
            "careerjet_api" => return_zero($request->careerjet_api, $request->careerjet_api_key),
            "careerjet_api_key" => $request->careerjet_api_key,
            "neauvoo_api" => return_zero($request->neauvoo_api, $request->neauvoo_api_key),
            "neauvoo_api_key" => $request->neauvoo_api_key,
            "jobsg8_job_api" => return_zero($request->jobsg8_job_api, $request->jobsg8_job_key),
            "jobsg8_job_key" => $request->jobsg8_job_key,
            "bestbananas_job_api" => return_zero($request->bestbananas_job_api, $request->bestbananas_job_key),
            "bestbananas_job_key" => $request->bestbananas_job_key,
            "allthetopbananas_job_api" => return_zero($request->allthetopbananas_job_api, $request->allthetopbananas_job_key),
            "allthetopbananas_job_key" => $request->allthetopbananas_job_key,
            "joblift_job_api" => $request->joblift_job_api,
            "joblift_job_key" => $request->joblift_job_key,
            "gulf_talent_job_api" => $request->gulf_talent_job_api,
            "gulf_talent_job_key" => $request->gulf_talent_job_key,
            "joblookup_job_api" => $request->joblookup_job_api,
            "joblookup_job_key" => $request->joblookup_job_key,


        );

        return json_encode($data);

    }

}
