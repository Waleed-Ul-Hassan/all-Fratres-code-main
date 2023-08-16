<?php

namespace App\Http\Controllers\Front;

use App\City;
use App\Industry;
use App\Job;
use App\JobAlert;
use App\Seeker;
use App\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class JobAlertsController extends Controller
{
    public function index(){

        $industries = Industry::all();
        $cities = City::all();
        $skills = Skill::all();

        return view('frontend.home.job-alerts', compact('industries', 'cities', 'skills'));

    }


    public function create(Request $request){


        if($request->has('__update__')){

            $request->validate([
                'name' => 'required',
                'job_title' => 'required',
                'skills' => 'required',
                'industry' => 'required',
                'city' => 'required',
                // 'g-recaptcha-response' => 'required|captcha',
//                'sending_frequency' => 'required',

            ]);

            $alert = JobAlert::find(decrypt($request->__update__));

            $request['email'] = $alert->email;

        }else{

            $request->validate([
                'name' => 'required',
                'job_title' => 'required',
                'skills' => 'required',
                'email' => 'required|email',
                'industry' => 'required',
                'city' => 'required',
//                'sending_frequency' => 'required',

            ]);
//            unique:job_alerts| paste this code for unique email validation
            $alert = new JobAlert();
            $alert->email = $request->email;
            $alert->random_id = Str::random(191);
        }


        // dd( $alert );
        if($alert){

            $alert->name = $request->name;
            $alert->industry_id = $request->industry;
//            $alert->sending_frequency = $request->sending_frequency;
            $alert->job_title = $request->job_title;
            $alert->city_id = $request->city;

            $seeker = Seeker::where('email', $request->email)->first();
            if($seeker){
                $alert->is_seeker = 1;
            }

            $alert->save();

            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);
            $to_name = $request->name;
            $to_email = $request->email;

//            Mail::send('frontend.emails.job_alerts.seeker_preferences_notification', ['alert' => $alert], function ($message) use ($alert) {
//                $message->subject('Hello world!');
//                $message->to($alert['email'], $alert['name']);
//            });

//            Mail::send("frontend.emails.job_alerts.seeker_preferences_notification", ['name' => $to_name], function
//            ($message) use ($to_name, $to_email) {
//                $message->to($to_email, $to_name)
//                    ->subject("Subscribed Email Alerts");
//                $message->from("noreply@fratres.net", "Fratres");
//            });


//            dd(config('mail'));
            

                if(config('mail.APP_SEND_EMAIL') != 'local') {
//                    $subject = "Subscribed Email Alerts";
//                    $mesg = view('frontend.emails.job_alerts.seeker_preferences_notification', compact('alert'))->render();
//                    verify_email($request->email, $subject, $mesg, "noreply@fratres.net", "noreply@fratres.net");

                    $data['alert'] = $alert;
                    session(['email' => $request->email]);
                    session(['subject' => 'Subscribed Email Alerts']);
                    Mail::send('frontend.emails.job_alerts.seeker_preferences_notification', $data , function($message){
                        $message->to(session('email'))
                            ->subject(session('subject'));
                    });
                }

        }

        if($request->has('__update__')){
            $message = swal_alert_message("Thankyou", "You have updated your email preferences successfully","Okay","success");
        }else{
            $message = swal_alert_message("Thankyou", "A confirmation emails has been sent to your email address","Okay","success");
        }

        return redirect()->back()->with($message);

    }

    public function create_alert(Request $request){

            $email_check = JobAlert::where("email", $request->email)->first();
            if ( $email_check ){
                $alert = $email_check;

            }else{

                $alert = new JobAlert();
            }

            $alert->name = $request->ea_title;
            $alert->industry_id = null;
//            $alert->sending_frequency = 3;
            $alert->job_title = $request->ea_title;
            $alert->email = $request->email;
            $alert->city_id = null;

            $seeker = Seeker::where('email', $request->email)->first();
            if($seeker){
                $alert->is_seeker = 1;
            }

            $alert->save();

            $skills = Skill::find($request->skills);
            $alert->skills()->sync($skills);

            Cookie::queue('alert_created', true, 2880);



            if(config('mail.APP_SEND_EMAIL') != 'local') {
//                $subject = "Subscribed Email Alerts";
//                $mesg = view('frontend.emails.job_alerts.seeker_preferences_notification', compact('alert'))->render();
//                verify_email($request->email, $subject, $mesg, "", "noreply@fratres.net");

                $data['alert'] = $alert;
                session(['email' => $request->email]);
                session(['subject' => 'Subscribed Email Alerts']);
                Mail::send('frontend.emails.job_alerts.seeker_preferences_notification', $data , function($message){
                    $message->to(session('email'))
                        ->subject(session('subject'));
                });
            }


        $message = swal_alert_message("Thankyou", "A confirmation emails has been sent to your email address","Okay","success");

        return response()->json($message);

//        return Response::with($message);

    }


    public function view($id)
    {

        $job_alert = JobAlert::where('random_id', $id)->first();
        if ($job_alert){
            $industries = Industry::all();
            $cities = City::all();
            $skills = Skill::all();

        return view('frontend.home.view-job-alerts', compact('job_alert', 'industries', 'cities', 'skills'));
    }else{

            return redirect('/')->with(swal_alert_message("Thankyou", "Email Does not exists","Okay","success"));

        }
    }


    public function confirm($id){

        JobAlert::where('random_id', $id)->update(['confirmed_at' => date("Y-m-d H:i:s")]);


        return redirect('email-preferences/view/'.$id)->with(swal_alert_message("Thankyou", "You have confirmed your email","Okay","success"));

    }

    public function unsubscribe($id)
    {


        $job_alert = JobAlert::where('random_id', $id)->first();
        if ($job_alert){
            $job_alert->email = 'deleted-' . $job_alert->email;
            $job_alert->save();
            $job_alert->delete();
    }
        return redirect('/')->with(swal_alert_message("We are sad", "You have Unsubscribed from jobs alert","Okay","success"));

    }

    public function ajax_unsubscribe($id)
    {


        $job_alert = JobAlert::where('random_id', $id)->first();
//        if ($job_alert){
//            $job_alert->email = 'deleted-' . $job_alert->email;
//            $job_alert->save();
//            $job_alert->delete();
//        }
        return 'ok';

    }

    public function disable($id)
    {

        $msg = 'Alert Status Updated';
        $job_alert = JobAlert::find($id);
        if ($job_alert){
            if($job_alert->sending_frequency != null){
                $job_alert->sending_frequency = null;
            }else{
                $job_alert->sending_frequency = 100;
            }
            $job_alert->save();
        }
        return $msg;

    }





    public function manage_subscriptions($email){

        $emails = decrypt($email);
        $job_alerts = JobAlert::where('email', $emails)->get();

        return view('frontend.emails.job_alerts.manage-alerts', compact('job_alerts', 'emails'));

    }


}
