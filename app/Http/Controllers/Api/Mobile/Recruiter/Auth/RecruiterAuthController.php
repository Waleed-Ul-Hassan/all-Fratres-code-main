<?php

namespace App\Http\Controllers\Api\Mobile\Recruiter\Auth;

use App\AdminSetting;
use App\City;
use App\Industry;
use App\Recruiter;
use App\Traits\ApiResponse;
use App\ValidateTokens;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class RecruiterAuthController extends Controller
{
    use ApiResponse;
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required','string','min:3','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
            'email' => 'required|email',
        ]);



        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $key => $error){
                $response['errors'][$key] = $error;
            }
            return $this->error("Validation failed", $response);
        }


        if (Auth::guard('recruiter')->attempt(['email' => $request->email, 'password' => $request->password, 'is_blocked' => 0, 'is_social_login' => 0], $request->remember_me)) {


            $recruiter = Auth::guard('recruiter')->user();
//            $recruiter->update(["email_verified_at" => date("Y-m-d H:i:s")]);
            $recruiter->reset_validity_cvs();
            if ($recruiter->email_verified_at == null) {

                $data['recruiter'] = $recruiter;
                session(['email' => $request->email]);
                session(['subject' => 'Confirm Email']);
                Mail::send('frontend.emails.recruiter_confirm_signup', $data , function($message){
                    $message->to(session('email'))
                        ->subject(session('subject'));
                });

                $response['error'] = "You have not Verified your email yet, Another Verfication Email has been seent to you please verify and proceed";


                return $this->error("Email not Verified", $response);
            }

            $token = new ValidateTokens();
            $validate = $token->accessToken("recruiter", $recruiter->id);

            $settings = AdminSetting::first();
            $recruiter->website_is_free = $settings->website_is_free;

            $response['access_token'] = $validate;
            $response['recruiter'] = $recruiter;

            return $this->success("Logged in", $response);
        }


        return $this->error("Username of password did not match");

    }

    public function signup()
    {

        $response['industries'] = Industry::all();
        $response['cities'] = City::all();

        return $this->success("Signup Page", $response);
    }

    public function create(Request $request)
    {

        $path = public_path('recruiters/profile/' . getDomainRoot());

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $validator = Validator::make($request->all(), [
            'password' => [ 'required', 'confirmed', 'string','min:4','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/' ],
            'email' => 'required|unique:recruiters|email','company_name' => 'required','company_url' => 'required','company_size' => 'required',
            'company_logo' => 'required','phone' => 'required','industry' => 'required','city' => 'required',
        ]);

        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $key => $error){
                $response['errors'][$key] = $error;
            }
            return $this->error("Validation failed", $response);
        }

//        'g-recaptcha-response' => 'required|captcha',

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

            $request['company_logo'] = $filename;
        }
//        dd('passed');
        $request['confirm_email_random_id'] = Str::random(35);
        $request['country_signed'] = getsubDomain();
        $recruiter = Recruiter::create($request->all());
//dd($recruiter);
        $data['recruiter'] = $recruiter;
        session(['email' => $recruiter->email]);
        session(['subject' => 'Confirm Email']);
        Mail::send('frontend.emails.recruiter_confirm_signup', $data , function($message){
            $message->to(session('email'))->subject(session('subject'));
        });


        $response['recruiter'] = $recruiter;

        return $this->success("You Have Successfully Created Account ! We have sent a confirmation email Please Confirm and login to your account", $response);


    }


    public function forgetPasswords(Request $request)
    {

        $email = $request->email;
        $recruiter = Recruiter::where('email', $email)->first();

        if ($recruiter) {
            $random_key = Str::random(35);
            $recruiter->confirm_email_random_id = $random_key;
            $result = $recruiter->save();

            $data['recruiter'] = $recruiter;
            session(['email' => $recruiter->email]);
            session(['subject' => 'Reset Password']);
            Mail::send('frontend.emails.recruiter_reset_password', $data , function($message){
                $message->to(session('email'))
                    ->subject(session('subject'));
            });

            return $this->success("Instrcutions to Reset Password has been sent to your Email");

        } else {

            return $this->error("This Email does not Exist");
        }


    }


    public function resize_square($image_resize, $filename){


        $path_square = public_path('recruiters/profile/' . getDomainRoot().'square_');

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


}
