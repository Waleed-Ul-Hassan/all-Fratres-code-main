<?php

namespace App\Http\Controllers\Front;

use App\City;
use App\Http\Controllers\Controller;
use App\Industry;
use App\Package;
use App\Page;
use App\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{


    public function aboutUs() {

        $page = Page::first();


        return view('frontend.home.pages.about-us', compact('page'));
    }

    public function privacy() {

        $page = Page::first();


        return view('frontend.home.pages.privacy', compact('page'));
    }

    public function terms() {

        $page = Page::first();


        return view('frontend.home.pages.terms', compact('page'));
    }

    public function publisher() {

        return view('frontend.home.pages.publisher');
    }

    public function published(Request $request) {

        $data['name'] = $request->name;
        $data['contact'] = $request->contact;
        $data['email'] = $request->email;
        $data['plan'] = $request->plan;
        $data['website'] = $request->website;
        $data['xml_feed'] = $request->xml_feed;


        if (config('mail.APP_SEND_EMAIL') != 'local') {
            $subject = "Published Email Alerts";
            $mesg = view('frontend.emails.published_alert_fratres', compact('data'))->render();


            verify_email('info@fratres.net', $subject, $mesg, "noreply@fratres.net", "noreply@fratres.net");
        }


        if (config('mail.APP_SEND_EMAIL') != 'local') {
            $subject = "Published Email Alerts";
            $mesg = view('frontend.emails.published_alert', compact('data'))->render();


            verify_email($request->email, $subject, $mesg, "noreply@fratres.net", "noreply@fratres.net");
        }

        return redirect()->back()->with('message', 'Request Send Successfully');
    }

    public function networks() {

        return view('frontend.home.pages.network_sites');
    }


    public function industries(){

        $industries = Industry::select("name","industry_slug", "total_jobs")->get();
        return view('frontend.home.pages.industries', compact('industries'));
    }

    public function locations(){

        $locations = City::select("name","city_slug",  "total_jobs")->get();
        return view('frontend.home.pages.locations', compact('locations'));
    }

    public function companies(){

        $recruiters = Recruiter::select("company_name", "total_jobs")->get();
        return view('frontend.home.pages.companies', compact('recruiters'));
    }

    public function advertise_jobs(){


        $packages = Package::orderBy("jobs", "ASC")->get();
//        foreach ($packages as $package){
//            pre(json_decode($package->features), true);
//        }
//        pre($packages);


        return view('frontend.home.pages.advertise-jobs', compact('packages'));
    }

    public function cvdatabase(){

        return view('frontend.home.pages.cvdatabase');
    }

    public function instant(){

        $instant = Session::get('instant_login');
        dd($instant);
    }

    public function home(){

        if (Auth::guard('seeker')->check()){
            dd(Auth::guard('seeker')->user());
        }else{
            dd('not logged in');
        }
    }











}
