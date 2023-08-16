<?php

namespace App\Http\Controllers\Api\Mobile\Seeker\Auth;

use App\Flag;
use App\Http\Requests\SeekerSignupRequest;
use App\Http\Requests\ValidateRequestsGeneric;
use App\JobAlert;
use App\NotificationLogs;
use App\Seeker;
use App\Traits\ApiResponse;
use App\ValidateTokens;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SeekerAuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request){

        try{

            $seeker = '';
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

            if (Auth::guard('seeker')->attempt(['email' => $request->email, 'password' => $request->password, 'is_blocked' => 0, 'is_social_login' => 0], $request->remember_me)) {

                $seeker = Auth::guard('seeker')->user();
                $token = new ValidateTokens();
                $validate = $token->accessToken("seeker", $seeker->id);

                $data['reg_step'] = $seeker->reg_step;
                $data['seeker_id'] = $validate;
                if ($seeker->reg_step == 2) {
                    return $this->error("Show Step 2 Screen", $data);
                }
                if ($seeker->email_verified_at == null) {

                    $data['seeker'] = $seeker;
                    session(['email' => $seeker->email]);
                    session(['subject' => 'Confirm Email']);
                    Mail::send('frontend.emails.seeker_confirm_signup', $data , function($message){
                        $message->to(session('email'))
                            ->subject(session('subject'));
                    });

                    $response['email_verified'] = null;
                    Auth::guard('seeker')->logout();
                    return $this->error("Email not Verified", $response);
                }

                if($seeker->is_upgraded == 1){
                    $date =  $seeker->expiry_upgrade;
                    if($date < date("Y-m-d h:i:s") ){
                        $seeker->is_upgraded = 0;
                        $seeker->save();
                    }
                }




                $response['access_token'] = $validate;
                $response['seeker'] = $this->seekerResponse($seeker);

                return $this->success("Logged in", $response);
            }
            return $this->error("Invalid Login Details");

        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }

    }

    public function seekerResponse($seeker){

        $seeker = Seeker::with(['industry'])->find($seeker->id);
        $seeker->hobbies = seeker_api_array($seeker->hobbies);
        $seeker->languages = seeker_api_array($seeker->languages);
        $flag = Flag::find($seeker->country);
        if($flag){
            $seeker->country = $flag->name;
        }

        return $seeker;
    }


    public function register_one(Request $request) {

        try{

            $validator = Validator::make($request->all(), [
                'first_name' => 'required','last_name' => 'required','email' => 'required|unique:seekers|email','dob' => 'required|date',
                'postcode' => 'required:number',
                'password' =>  ['required','confirmed','string','min:4','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
                'current_job_title' => 'required',
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }
            $request['country_signed'] = getsubDomain();
            $request['reg_step'] = 2;

            $seeker = Seeker::create($request->all());

            JobAlert::create(["name" => $request->first_name, "job_title" => $request->current_job_title, "email" => $request->email,"random_id" => Str::random(90)]);

            $seeker->profile_strength();


            if ($seeker) {
                $token = new ValidateTokens();
                $validate = $token->accessToken("seeker", $seeker->id);
                $response['seeker_id'] = $validate;
                return $this->success("Data saved successfully", $response);
            }else{
                return $this->error("Invalid Email or Password");
            }

        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }

    }


    public function register_create(Request $request) {

        try{

            $path = public_path('seekers/cvs/' . getDomainRoot());

            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $token = new ValidateTokens();
            $seeker = $token->seeker($request->seeker_id);

            if(!$seeker){
                return $this->error("No Records found");
            }
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'expected_salary' => 'required:number',
                'available_job_type' => 'required|array',
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }


            if ($request->has('cv_resume')) {
                $time = time() . md5(time()) . Str::limit(10);
                $imageName = $time . '-' . $request->cv_resume->getClientOriginalName() . '.' . $request->cv_resume->getClientOriginalExtension();

                $request->cv_resume->move($path, $imageName);
                $data['cv_resume'] = $imageName;

            }

            $phone = array("phone" => $request->phone);

            $data['available_job_type'] = implode(",", $request->available_job_type);
            $data['expected_salary'] = $request->expected_salary;
            $data['reg_step'] = 0;
            $data['confirm_email_random_id'] = Str::random(35);
            $data['phone'] = json_encode($phone);
            $data['country_signed'] = getsubDomain();

            $seeker->update($data);
            $seeker->profile_strength();

            $data['seeker'] = $seeker;
            session(['email' => $seeker->email]);
            session(['subject' => 'Confirm Email']);
            Mail::send('frontend.emails.seeker_confirm_signup', $data , function($message){
                $message->to(session('email'))
                    ->subject(session('subject'));
            });


            return $this->success("Account Created Successfully");

        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }

    }


    public function forgetPasswords(Request $request) {

        try{

            $email = $request->email;
            $seeker = Seeker::where('email', $email)->first();

            if ($seeker) {
                $random_key = Str::random(35);;
                $seeker->confirm_email_random_id = $random_key;
                $seeker->save();

                $data['seeker'] = $seeker;
                session(['email' => $seeker->email]);
                session(['subject' => 'Reset Password']);
                Mail::send('frontend.emails.seeker_reset_password', $data , function($message){
                    $message->to(session('email'))
                        ->subject(session('subject'));
                });
                //mail ends here

                return $this->success('Instrcutions to Reset Password has been sent to your Email');
            } else {
                return $this->error('This Email does not Exist');
            }

        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }


    }

    public function resetPasswords(Request $request) {

        try{

            $validator = Validator::make($request->all(), [
                'password' => ['required','confirmed','string','min:4','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/']
            ]);


            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }

            $confirm_email_random_id = $request->confirm_email_random_id;
            $seeker = Seeker::where('confirm_email_random_id', $confirm_email_random_id)->first();

            $newpass = $request->password;
            $confirmPass = $request->confirm_password;

            $seeker->password = $newpass;
            $seeker->is_social_login = 0;
            $result = $seeker->save();

            NotificationLogs::create([
                "notifier_id" => $request->seekerIs->id,
                "notifier_type" => 'seeker',
                "message" => 'You Succssfuly Changed Your Password',
                "url" => "#",
            ]);


            return $this->success('You Have Succssfuly Changed Password');

        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }

    }



}
