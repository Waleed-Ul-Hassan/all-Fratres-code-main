<?php

namespace App\Http\Controllers\Recruiter;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateRequestsGeneric;
use App\Industry;
use App\Jobs\RecruiterCount;
use App\NotificationLogs;
use App\Recruiter;
use App\Traits\TrackRecruiter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Laravel\Socialite\Facades\Socialite;

class RecruiterAuthController extends Controller
{
    use TrackRecruiter;


    public function login()
    {
        $errors = FALSE;
//        if( ip() == '39.53.176.196' ){
//
//            dd($id);
//            RecruiterCount::dispatchNow();
//        }
//        $minutes = 600000;
//        $counter = 1;
//
//        if(Cache::has('hits_count_register')){
//            $counter = Cache::get('hits_count_register');
//        }
//
//        Cache::put('hits_count_register', $counter, $minutes);
//        try{
//            $t = new \App\TrackRecruiter();
//            $t->atloginPage();
//        }catch (\Exception $e){
//            dd($e->getMessage());
//        }


        return view('frontend.recruiter.auth.login', compact('errors'));
    }

    public function login_post(ValidateRequestsGeneric $request)
    {

//        \App\TrackRecruiter::class->loginPage();

        $request->validate([
            'password' => [
                'required',
                'string'
            ],
            'email' => 'required|email',
        ]);

        if (Auth::guard('recruiter')->attempt(['email' => $request->email, 'password' => $request->password, 'is_blocked' => 0, 'is_social_login' => 0], $request->remember_me)) {

            $recruiter = Auth::guard('recruiter')->user();
            $recruiter->reset_validity_cvs();
            if ($recruiter->email_verified_at == null) {


                if (Config::get('mail.APP_SEND_EMAIL') != 'local') {
//                    $subject = "Confirm Email";
//                    $mesg = view('frontend.emails.recruiter_confirm_signup', compact('recruiter'))->render();
//                    verify_email($request->email, $subject, $mesg, "", "noreply@fratres.net");

                    $data['recruiter'] = $recruiter;
                    session(['email' => $request->email]);
                    session(['subject' => 'Confirm Email']);
                    Mail::send('frontend.emails.recruiter_confirm_signup', $data , function($message){
                        $message->to(session('email'))
                            ->subject(session('subject'));
                    });

                }

                $notification = swal_alert_message_error("Oops!", "You have not Verified your email yet, Another Verfication Email has been seent to you please verify and proceed.");
                Auth::guard('recruiter')->logout();
                return redirect('recruiter/login')->with($notification);
            }

            $t = new \App\TrackRecruiter();
            $t->loginPage();

            return redirect('recruiter/dashboard');
        }


        $notification = swal_alert_message("Oops!", "Email or Password did not match", "Okay", 'error');
        return redirect('recruiter/login')->with($notification);

    }

    public function register()
    {

        $industries = Industry::all();
        $cities = City::all();

        return view('frontend.recruiter.auth.register', compact('industries', 'cities'));
    }

    public function create(ValidateRequestsGeneric $request)
    {


        $path = public_path('recruiters/profile/');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $data = $request->validate([
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
            'email' => 'required|unique:recruiters|email',
            'company_name' => 'required',
            'company_url' => 'required',
            'company_size' => 'required',
            'company_logo' => 'required',
            'phone' => 'required',
            'industry' => 'required',
            'city' => 'required',
//            'g-recaptcha-response' => 'required|captcha',
        ]);

        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $filename = time() . '.' . $request->company_logo->getClientOriginalExtension();

            $image_resize = Image::make($image->getRealPath());
//            $image_resize_square = Image::make($image->getRealPath());
            $image_resize->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->save($path . $filename);
            $this->resize_square($image_resize, $filename);

            $data['company_logo'] = $filename;
        }
//        dd('passed');
        $data['confirm_email_random_id'] = Str::random(35);
        $data['country_signed'] = getsubDomain();
        $data['ip_origin'] = getVisitorDefault();
        $recruiter = Recruiter::create($data);

        if (Config::get('mail.APP_SEND_EMAIL') != 'local') {

//            $subject = "Confirm Email";
//            $mesg = view('frontend.emails.recruiter_confirm_signup', compact('recruiter'))->render();
//            verify_email($recruiter->email, $subject, $mesg, "", "noreply@fratres.net");

            $data['recruiter'] = $recruiter;
            session(['email' => $recruiter->email]);
            session(['subject' => 'Confirm Email']);
            Mail::send('frontend.emails.recruiter_confirm_signup', $data , function($message){
                $message->to(session('email'))
                    ->subject(session('subject'));
            });

        }

        $notification = swal_alert_message("Congratulations", 'You Have Successfully Created Account ! We have sent a confirmation email Please Confirm and login to your account', "Okay", 'success');

        return redirect('recruiter/login')->with($notification);

    }

    public function confrimEmail($confirm_email_random_id)
    {

        $recruiter = Recruiter::where('confirm_email_random_id', $confirm_email_random_id)->first();

        $recruiter->email_verified_at = Carbon::now()->toDateTimeString();

        $recruiter->save();

        NotificationLogs::create([
            "notifier_id" => recruiter_logged('id'),
            "notifier_type" => 'recruiter',
            "message" => 'You have confirmed Email',
            "url" => "#",
        ]);

        $notification = swal_alert_message("Congratulations", "You have confirmed Email", "Okay", 'success');
        return redirect('recruiter/login')->with($notification);
    }

    public function forgetPassword()
    {

        return view('frontend.recruiter.auth.forget-password');

    }

    public function forgetPasswords(Request $request)
    {

        $email = $request->email;
        $recruiter = Recruiter::where('email', $email)->first();

        if ($recruiter) {
            $random_key = Str::random(35);
            $recruiter->confirm_email_random_id = $random_key;
            $result = $recruiter->save();

            if (Config::get('mail.APP_SEND_EMAIL') != 'local') {
//                $subject = "Reset Password";
//                $mesg = view('frontend.emails.recruiter_reset_password', compact('recruiter'))->render();
//                verify_email($recruiter->email, $subject, $mesg, "", "noreply@fratres.net");

                $data['recruiter'] = $recruiter;
                session(['email' => $recruiter->email]);
                session(['subject' => 'Reset Password']);
                Mail::send('frontend.emails.recruiter_reset_password', $data , function($message){
                    $message->to(session('email'))
                        ->subject(session('subject'));
                });
                //mail ends here
            }

            $notification = swal_alert_message("Congratulations", "Instrcutions to Reset Password has been sent to your Email", "Okay", 'success');
            return redirect('recruiter/login')->with($notification);
        } else {
            $notification = swal_alert_message("Warning", "This Email does not Exist", "Okay", 'error');
            return redirect('recruiter/login')->with($notification);
        }


    }

    public function resetPassword($confirm_email_random_id)
    {

        $recruiter = Recruiter::where('confirm_email_random_id', $confirm_email_random_id)->first();

        return view('frontend.recruiter.auth.reset-password', compact('recruiter'));
    }

    public function resetPasswords(ValidateRequestsGeneric $request)
    {


        $data = $request->validate([
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
        $recruiter = Recruiter::where('confirm_email_random_id', $confirm_email_random_id)->first();
//        dd($recruiter);

//        $newpass = $request->password;
        $data['is_social_login'] = 0;
        $data['confirm_email_random_id'] = '';
        $recruiter->update($data);
//        $recruiter->password = $newpass;
//        $recruiter->save();
        $notification = swal_alert_message("Congratulations", 'You Have Successfully Changed Password', "Okay", 'success');

        return redirect('recruiter/login')->with($notification);
    }


    /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function LinkedinredirectToProvider()
    {

        $redirect = url('recruiter/linkedin/callback');
//        $redirect = Config::get('services.linkedin_recruit.redirect');

        return Socialite::with('linkedin')->redirectUrl($redirect)->redirect();

    }

    /**
     * Obtain the user information from Linkedin.
     *
     * @return \Illuminate\Http\Response
     */
    public function LinkedinhandleProviderCallback()
    {
        $redirect = url('recruiter/linkedin/callback');
//        $redirect = Config::get('services.linkedin_recruit.redirect');

        try {

            $user = Socialite::driver('linkedin')->redirectUrl($redirect)->stateless()->user();

        }

        catch (\Exception $e) {

            return redirect ('/');
        }

        $path = public_path('recruiters/profile/');
        $path_square = public_path('recruiters/profile/square_');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }





        $recruiter = Recruiter::updateOrCreate(
            [
                'email' => $user->getEmail()

            ],
            [
                'company_name' => $user->getName(),
                'token' => $user->token,
                'password' => \Hash::make($user->token),
                'expiresIn' => $user->expiresIn,

                "is_social_login" => 1,
                'social_channel' => 'linkdin',
                "social_token" => $user->token,
                "social_login_id" => $user->getId(),
                "email_verified_at" => date("Y-m-d")

            ]
        );

        $company_image = $recruiter->company_logo;
        if( $recruiter->company_logo == '' ){

            $image_path = $path . $user->id . ".jpg";
            $image_path_square = $path_square . $user->id . ".jpg";

            if (File::exists($image_path)) {
                File::delete($image_path);
                File::delete($image_path_square);
            }

            $fileContents = file_get_contents($user->avatar_original);
            File::put($image_path, $fileContents);

            $recruiter = Recruiter::where('social_login_id', $user->getId())->first();
            $recruiter->company_logo = $user->id . ".jpg";
        }

        $recruiter->country_signed = getsubDomain();
        $recruiter->ip_origin = getVisitorDefault();

        $recruiter->reset_validity_cvs();
        $recruiter->save();

        if( $company_image == '' ){

            $filename = $user->id . ".jpg";
            $image_resize = Image::make($path . $filename);
            $this->resize_square($image_resize, $filename);

        }

//        $r = new \App\TrackRecruiter();
//        $r->signedup(true);
//        dd($recruiter);
        if ($recruiter->is_blocked == 0) {


            Auth::guard('recruiter')->login($recruiter, true);
            return redirect('recruiter/dashboard');
        } else {
//            dd();
            return redirect('recruiter/login')->with(swal_alert_message_error());

        }


    }

    /**
     * Redirect the user to the Linkedin authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function FacebookredirectToProvider()
    {

        $redirect = url('recruiter/facebook/callback');
//        $redirect = Config::get('services.facebook.redirect_recruiter');

        return Socialite::with('facebook')->redirectUrl($redirect)->redirect();
//        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Linkedin.
     *
     * @return \Illuminate\Http\Response
     */
    public function FacebookhandleProviderCallback()
    {

        $redirect = url('recruiter/facebook/callback');

        if (!request()->has('code') || request()->has('denied')) {
            return redirect('/');
        }
        try {

//            $redirect = Config::get('services.facebook.redirect_recruiter');

            $user = Socialite::driver('facebook')->redirectUrl($redirect)->stateless()->user();

        }

        catch (\Exception $e) {

            return redirect ('/');
        }

        $path = public_path('recruiters/profile/');
        $path_square = public_path('recruiters/profile/square_');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }



        $recruiter = Recruiter::updateOrCreate(
            [
                'email' => $user->getEmail()

            ],
            [
                'company_name' => $user->getName(),
                'token' => $user->token,
                'password' => \Hash::make($user->token),
                'expiresIn' => $user->expiresIn,

                "is_social_login" => 1,
                'social_channel' => 'facebook',
                "social_token" => $user->token,
                "social_login_id" => $user->getId(),
                "email_verified_at" => date("Y-m-d")

            ]
        );

        $company_image = $recruiter->company_logo;
        if( $recruiter->company_logo == '' ){

            $image_path = $path . $user->id . ".jpg";
            $image_path_square = $path_square . $user->id . ".jpg";

            if (File::exists($image_path)) {
                File::delete($image_path);
                File::delete($image_path_square);
            }

            $fileContents = file_get_contents($user->avatar_original);
            File::put($image_path, $fileContents);

            $recruiter = Recruiter::where('social_login_id', $user->getId())->first();
            $recruiter->company_logo = $user->id . ".jpg";

        }

        $recruiter->country_signed = getsubDomain();
        $recruiter->ip_origin = getVisitorDefault();
        $recruiter->reset_validity_cvs();
        $recruiter->save();

        if( $company_image == '' ){

            $filename = $user->id . ".jpg";
            $image_resize = Image::make($image_path);
            $this->resize_square($image_resize, $filename);

        }

//        $r = new \App\TrackRecruiter();
//        $r->signedup(true);

        if ($recruiter->is_blocked == 0) {

            Auth::guard('recruiter')->login($recruiter, true);
            return redirect('recruiter/dashboard');
        } else {
            return redirect('recruiter/login')->with(swal_alert_message_error());

        }


    }

    public function resize_square($image_resize, $filename){


        $path_square = public_path('recruiters/profile/square_');

        //resize square img
        $width  = $image_resize->width();
        $height = $image_resize->height();


        /*
        *  canvas
        */
        $dimension = 2362;

        $vertical   = (($width < $height) ? true : false);
        $horizontal = (($width > $height) ? true : false);
        $square     = (($width = $height) ? true : false);

        if ($vertical) {
            $top = $bottom = 0;
            $newHeight = ($dimension) - ($bottom + $top);
            $image_resize->resize(null, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($horizontal) {
            $right = $left = 0;
            $newWidth = ($dimension) - ($right + $left);
            $image_resize->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($square) {
            $right = $left = 0;
            $newWidth = ($dimension) - ($left + $right);
            $image_resize->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        }

        $image_resize->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');
        $image_resize->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image_resize->save($path_square . $filename);


    }

//    public function resize_square($image_resize, $filename)
//    {
//
//        $path = public_path('recruiters/profile/' . getDomainRoot());
//        $path_square = public_path('recruiters/profile/' . getDomainRoot() . "square_");
//
//        if (!File::isDirectory($path)) {
//            File::makeDirectory($path, 0777, true, true);
//        }
//        //resize square img
//        $width = $image_resize->width();
//        $height = $image_resize->height();
//
//
//        /*
//        *  canvas
//        */
//        $dimension = 200;
//
//        $vertical = (($width < $height) ? true : false);
//        $horizontal = (($width > $height) ? true : false);
//        $square = (($width = $height) ? true : false);
//
//        if ($vertical) {
//            $top = $bottom = 145;
//            $newHeight = ($dimension) - ($bottom + $top);
//            $image_resize->resize(null, $newHeight, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//
//        } else if ($horizontal) {
//            $right = $left = 145;
//            $newWidth = ($dimension) - ($right + $left);
//            $image_resize->resize($newWidth, null, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//
//        } else if ($square) {
//            $right = $left = 145;
//            $newWidth = ($dimension) - ($left + $right);
//            $image_resize->resize($newWidth, null, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//
//        }
//
//        $image_resize->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');
//        $image_resize->fit(200, 80, function ($constraint) {
//            $constraint->upsize();
//        });
//        $image_resize->save($path_square . $filename);
//
//    }

}
