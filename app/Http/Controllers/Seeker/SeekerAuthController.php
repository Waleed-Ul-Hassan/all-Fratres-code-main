<?php

namespace App\Http\Controllers\Seeker;

use App\CollectNewsletter;
use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeekerSignupRequest;
use App\Http\Requests\ValidateRequestsGeneric;
use App\JobAlert;
use App\Mail\CompanyForgetEmail;
use App\NotificationLogs;
use App\Seeker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SeekerAuthController extends Controller
{
    public function index() {

//        if(ip() == '39.53.158.207'){
//            dd( getVisitorDefault() );
//        }

        return view('frontend.seeker.auth.register-one');

    }

    public function cv_maker_index(){

        return view('frontend.seeker.cv-maker.register');

    }

    public function register_one(SeekerSignupRequest $request) {

        $validated = $request->validated();

        if ($validated) {

//            dd($request->relocate);
            $validated['reg_step'] = 2;
            $validated['country_signed'] = getsubDomain();
            if($request->has('seeker_cvmaker_input')){
                $validated['reg_step'] = 0;
                $validated['is_social_login'] = 0;
                $validated['confirm_email_random_id'] = Str::random(35);
            }
            $validated['relocate'] = $request->relocate;
           
            $validated['ip_origin'] = getVisitorDefault();

            $seeker = Seeker::create($validated);

            JobAlert::create(["name" => $request->first_name, "job_title" => $request->current_job_title, "email" => $request->email,"random_id" => Str::random(90)]);

            $seeker->profile_strength();

            if($request->has('seeker_cvmaker_input')) {
                if (Config::get('mail.APP_SEND_EMAIL') != 'local') {
//                    $subject = "Confirm Email";
//                    $mesg = view('frontend.emails.seeker_confirm_signup', compact('seeker'))->render();
//                    verify_email($seeker->email, $subject, $mesg, "", "noreply@fratres.net");

                    $data['seeker'] = $seeker;

                    session(['email' => $seeker->email]);
                    session(['subject' => 'Confirm Email']);

                    Mail::send('frontend.emails.seeker_confirm_signup', $data , function($message){
                        $message->to(session('email'))
                            ->subject(session('subject'));
                    });

                }

                if (Auth::guard('seeker')->attempt(['email' => $request->email, 'password' => $request->password, 'is_blocked' => 0, 'is_social_login' => 0], $request->remember_me)) {

                    $seeker = Auth::guard('seeker')->user();

                    $notification = swal_alert_message("Congratulations", "You are LoggedIn", "Okay", 'success');
                    return redirect('seeker/cv-maker')->with($notification);
                }

            }


            if ($seeker) {
                Session::put('register_step', $seeker->id);
                Session::save();

                return redirect('/seeker/register-step');

            }
        }

    }

    public function register_step_two() {


        if (Session::get('register_step')) {

            return view('frontend.seeker.auth.register-two');

        } else {

            $notification = swal_alert_message_error();

            return redirect('seeker/register');
        }

    }

    public function register_create(ValidateRequestsGeneric $request) {

        $path = public_path('seekers/cvs/' . getDomainRoot());

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $seeker = Seeker::find(Session::get('register_step'));

        if ($seeker) {

            $data = $request->validate([
                'phone' => 'required',
                'expected_salary' => 'required:number',
                'available_job_type' => 'required|array',
            ]);

            if ($request->has('cv_resume')) {
                $time = time() . md5(time()) . Str::limit(10);
                $imageName = $time . '-' . $request->cv_resume->getClientOriginalName() . '.' . $request->cv_resume->getClientOriginalExtension();

                $request->cv_resume->move($path, $imageName);
                $data['cv_resume'] = $imageName;

            }



            $phone = array("phone" => $request->phone);

            $data['country_signed'] = getsubDomain();
            $data['available_job_type'] = implode(",", $request->available_job_type);
            $data['reg_step'] = 0;
            $data['confirm_email_random_id'] = Str::random(35);
            $data['phone'] = json_encode($phone);

            $seeker->update($data);
            $seeker->profile_strength();

            Session::forget('register_step');
            Session::save();

//            Mail::to($seeker->email)->send(new ConfirmationEmail($seeker));
            if( Config::get('mail.APP_SEND_EMAIL') != 'local'){
//                $subject = "Confirm Email";
//                $mesg = view('frontend.emails.seeker_confirm_signup', compact('seeker'))->render();
//                verify_email($seeker->email, $subject, $mesg, "", "noreply@fratres.net");

                $data['seeker'] = $seeker;
                session(['email' => $seeker->email]);
                session(['subject' => 'Confirm Email']);
                Mail::send('frontend.emails.seeker_confirm_signup', $data , function($message){
                    $message->to(session('email'))
                        ->subject(session('subject'));
                });
            }

            $notification = swal_alert_message('You have successfully created an account', 'Please Confrim Email and Login to Continue', 'Okay', 'success');


            return redirect('seeker/login')->with($notification);

        } else {

            $notification = swal_alert_message_error();
            return redirect('seeker/register')->with($notification);
        }

    }

    public function confrimEmail($confirm_email_random_id) {

        $seeker = Seeker::where('confirm_email_random_id', $confirm_email_random_id)->first();

        $seeker->email_verified_at = Carbon::now()->toDateTimeString();

        $result = $seeker->save();

        NotificationLogs::create([
            "notifier_id" => seeker_logged('id'),
            "notifier_type" => 'seeker',
            "message" => 'You have confirmed Email',
            "url" => "#",
        ]);

        $notification = swal_alert_message("Congratulations", "You have confirmed Email", "Okay", 'success');
        return redirect('seeker/login')->with($notification);
    }


    public function login() {

        return view('frontend.seeker.auth.login');

    }


    public function login_post(ValidateRequestsGeneric $request) {
        $seeker = '';
        $request->validate([
            'password' => [
                'required',
                'string',
                'min:3',             // must be at least 3 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'email' => 'required|email',
        ]);

        if (Auth::guard('seeker')->attempt(['email' => $request->email, 'password' => $request->password, 'is_blocked' => 0, 'is_social_login' => 0], $request->remember_me)) {

            $seeker = Auth::guard('seeker')->user();

            if ($seeker->reg_step == 2) {
                Session::put('register_step', $seeker->id);
                Session::save();

                return redirect('/seeker/register-step');
            }

            if ($seeker->email_verified_at == null) {


                if( Config::get('mail.APP_SEND_EMAIL') != 'local') {
//                    $subject = "Confirm Email";
//                    $mesg = view('frontend.emails.seeker_confirm_signup', compact('seeker'))->render();
//                    verify_email($request->email, $subject, $mesg, "", "noreply@fratres.net");

                    $data['seeker'] = $seeker;
                    session(['email' => $seeker->email]);
                    session(['subject' => 'Confirm Email']);
                    Mail::send('frontend.emails.seeker_confirm_signup', $data , function($message){
                        $message->to(session('email'))
                            ->subject(session('subject'));
                    });
                }

                $notification = swal_alert_message_error("Oops!", "You have not Verified your email yet, Another Verfication Email has been sent to you please verify and proceed.");
                Auth::guard('seeker')->logout();
                return redirect('seeker/login')->with($notification);
            }

            if($seeker->is_upgraded == 1){
               $date =  $seeker->expiry_upgrade;
               if($date < date("Y-m-d h:i:s") ){
                       $seeker->is_upgraded = 0;
                       $seeker->save();
               }
            }

            return redirect('seeker/dashboard');
        }


        $notification = swal_alert_message("Oops!", "Email or Password did not match", "Okay", 'error');
        return redirect('seeker/login')->with($notification);

    }


    public function forgetPassword() {

        return view('frontend.seeker.auth.forget-password');

    }

    public function forgetPasswords(Request $request) {


        $email = $request->email;
        $seeker = Seeker::where('email', $email)->first();

        if ($seeker) {
            $random_key = Str::random(35);;
            $seeker->confirm_email_random_id = $random_key;
            $result = $seeker->save();

            if( Config::get('mail.APP_SEND_EMAIL') != 'local') {
//                $subject = "Reset Password";
//                $mesg = view('frontend.emails.seeker_reset_password', compact('seeker'))->render();
//                verify_email($seeker->email, $subject, $mesg, "", "noreply@fratres.net");

                $data['seeker'] = $seeker;
                session(['email' => $seeker->email]);
                session(['subject' => 'Reset Password']);
                Mail::send('frontend.emails.seeker_reset_password', $data , function($message){
                    $message->to(session('email'))
                        ->subject(session('subject'));
                });
            }
            //mail ends here

            $notification = swal_alert_message("Congratulations", "Instrcutions to Reset Password has been sent to your Email", "Okay", 'success');
            return redirect('seeker/login')->with($notification);
        } else {
            $notification = swal_alert_message("Warning", "This Email does not Exist", "Okay", 'error');
            return redirect('seeker/forget-password')->with($notification);
        }


    }

    public function resetPassword($confirm_email_random_id) {

        $seeker = Seeker::where('confirm_email_random_id', $confirm_email_random_id)->first();

        return view('frontend.seeker.auth.reset-password', compact('seeker'));
    }

    public function resetPasswords(ValidateRequestsGeneric $request) {


        $request->validate([
            'password' => [
                'required',
                'confirmed',
                'string',
                'min:4',             // must be at least 3 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],

        ]);

        $confirm_email_random_id = $request->confirm_email_random_id;
        $seeker = Seeker::where('confirm_email_random_id', $confirm_email_random_id)->first();

        $newpass = $request->password;
        $confirmPass = $request->confirm_password;



        $seeker->password = $newpass;
        $seeker->is_social_login = 0;
        $result = $seeker->save();

        NotificationLogs::create([
            "notifier_id" => seeker_logged('id'),
            "notifier_type" => 'seeker',
            "message" => 'You Succssfuly Changed Your Password',
            "url" => "#",
        ]);

        $notification = swal_alert_message("Congratulations", 'You Have Succssfuly Changed Password', "Okay", 'success');

        return redirect('seeker/login')->with($notification);
    }




    /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function LinkedinredirectToProvider() {

        $redirect = url('seeker/linkedin/callback');

        return Socialite::driver('linkedin')->redirectUrl($redirect)->redirect();
//        return Socialite::driver('linkedin')->redirect();
    }

    /**
     * Obtain the user information from Linkedin.
     *
     * @return \Illuminate\Http\Response
     */
    public function LinkedinhandleProviderCallback() {

        $redirect = url('seeker/linkedin/callback');

        try {

            $user = Socialite::driver('linkedin')->redirectUrl($redirect)->stateless()->user();

        }

        catch (\Exception $e) {

            return redirect ('/');
        }

        $path = public_path('seekers/profile/' . getDomainRoot());

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }


        $seeker = Seeker::updateOrCreate(
            [
                'email' => $user->getEmail()

            ],
            [
                'first_name' => $user->getName(),
                'token' => $user->token,
                'password' => \Hash::make($user->token),
                'name' => $user->getName(),
                'expiresIn' => $user->expiresIn,
//                'avatar' => $user->avatar_original,
                "is_social_login" => 1,
                'social_channel' => 'linkdin',
                "social_token" => $user->token,
                "social_login_id" => $user->getId(),
                "email_verified_at" => date("Y-m-d"),
                "reg_step" => 1

            ]
        );

//        CollectNewsletter::updateOrCreate(['email' => $user->getEmail()]);


        JobAlert::updateOrCreate(
            [
                "name" => $user->getName(),
                "job_title" => "e",
                "email" => $user->getEmail(),
            ],[
                "random_id" => Str::random(90)
            ]
        );

        if($seeker->avatar == ''){

            $fileContents = file_get_contents($user->avatar_original);
            File::put($path . $user->id . ".jpg", $fileContents);

            $seeker = Seeker::where('social_login_id', $user->getId())->first();
            $seeker->avatar = $user->id . ".jpg";

        }


        $seeker->country_signed = getsubDomain();
        $seeker->ip_origin = getVisitorDefault();

        $seeker->profile_strength();
        $seeker->save();

        if ($seeker->is_blocked == 0) {

            Auth::guard('seeker')->login($seeker, true);


            if($seeker->is_upgraded == 1){
                $date =  $seeker->expiry_upgrade;
                if($date < date("Y-m-d h:i:s") ){
                    $seeker->is_upgraded = 0;
                    $seeker->save();
                }
            }

            Session::put('instant_login', $seeker->id);

            return redirect('seeker/dashboard');
        } else {
            return redirect('seeker/login')->with(swal_alert_message_error());

        }


    }



    /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function FacebookredirectToProvider() {

        $redirect = url('seeker/facebook/callback');

        return Socialite::driver('facebook')->redirectUrl($redirect)->redirect();
    }

    /**
     * Obtain the user information from Linkedin.
     *
     * @return \Illuminate\Http\Response
     */
    public function FacebookhandleProviderCallback() {

        $redirect = url('seeker/facebook/callback');

        if (!request()->has('code') || request()->has('denied')) {
            return redirect('/');
        }

        try {

            $user = Socialite::driver('facebook')->redirectUrl($redirect)->stateless()->user();
        }

        catch (\Exception $e) {

            return redirect ('/');
        }

        $path = public_path('seekers/profile/' . getDomainRoot());

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }



        $seeker = Seeker::updateOrCreate(
            [
                'email' => $user->getEmail()

            ],
            [
                'first_name' => $user->getName(),
                'token' => $user->token,
                'password' => \Hash::make($user->token),
                'name' => $user->getName(),
                'expiresIn' => $user->expiresIn,
//                'avatar' => $user->avatar_original,
                "is_social_login" => 1,
                'social_channel' => 'facebook',
                "social_token" => $user->token,
                "social_login_id" => $user->getId(),
                "email_verified_at" => date("Y-m-d"),
                "reg_step" => 1

            ]
        );

//        CollectNewsletter::updateOrCreate(['email' => $user->getEmail()]);
        JobAlert::updateOrCreate(
            [
                "name" => $user->getName(),
                "job_title" => "e",
                "email" => $user->getEmail(),
            ],[
                "random_id" => Str::random(90)
            ]
        );

        if ( $seeker->avatar == ''){


            $fileContents = file_get_contents($user->avatar_original);
            File::put($path . $user->id . ".jpg", $fileContents);

            $seeker = Seeker::where('social_login_id', $user->getId())->first();
            $seeker->avatar = $user->id . ".jpg";
        }

        $seeker->country_signed = getsubDomain();
        $seeker->ip_origin = getVisitorDefault();
        $seeker->profile_strength();
        $seeker->save();

        if ($seeker->is_blocked == 0) {

            if($seeker->is_upgraded == 1){
                $date =  $seeker->expiry_upgrade;
                if($date < date("Y-m-d h:i:s") ){
                    $seeker->is_upgraded = 0;
                    $seeker->save();
                }
            }

            Auth::guard('seeker')->login($seeker, true);
            return redirect('seeker/dashboard');
        } else {
            return redirect('seeker/login')->with(swal_alert_message_error());

        }


    }


    public function send_mail() {

//        echo view('frontend.emails.test')->render();
//        die();

        $user = array('name ' => 'saqlain');

//        Mail::to('saqlainbukhari26@gmail.com')->send(new ConfirmationEmail($data));
        $subject = "Confirmation Email";
        $mesg = view('frontend.emails.test', compact('user'))->render();

        verify_email("saqlainbukhari26@gmail.com", $subject, $mesg, "", "noreply@fratres.net");


//        Mail::send('frontend.emails.test', ['user' => $data], function ($m) use ($data) {
//            $m->from('info@fratres.net', 'Fratres Confirmation Email');
//            $m->to("saqlainbukhari26@gmail.com", "Saqlain")->subject('Your Reminder!');
//        });


    }


}
