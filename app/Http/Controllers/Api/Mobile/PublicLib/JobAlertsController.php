<?php

namespace App\Http\Controllers\Api\Mobile\PublicLib;

use App\City;
use App\Industry;
use App\JobAlert;
use App\Seeker;
use App\Skill;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class JobAlertsController extends Controller
{
    use ApiResponse;


    public function index(){

        $data['industries'] = Industry::all();
        $data['cities'] = City::all();

        return $this->success("Alerts Details", $data);
    }

    public function create_alert(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'title' => 'required',
            'industry_id' => 'required',
            'city_id' => 'required',
        ]);

        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $key => $error){
                $response['errors'][$key] = $error;
            }
            return $this->error("Validation failed", $response);
        }

        $alert = new JobAlert();

        $alert->name = $request->title;
        $alert->industry_id = $request->industry_id;
        $alert->job_title = $request->title;
        $alert->email = $request->email;
        $alert->city_id = $request->city_id;

        $seeker = Seeker::where('email', $request->email)->first();
        if($seeker){
            $alert->is_seeker = 1;
        }

        $alert->save();

        $data['alert'] = $alert;
        session(['email' => $request->email]);
        session(['subject' => 'Subscribed Email Alerts']);
        Mail::send('frontend.emails.job_alerts.seeker_preferences_notification', $data , function($message){
            $message->to(session('email'))->subject(session('subject'));
        });

        return $this->success('A confirmation emails has been sent to your email address');
    }

    public function update_alert(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required',
                'title' => 'required',
                'industry_id' => 'required',
                'city_id' => 'required',
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }


            $alert = JobAlert::find($request->__update__);

            if($alert){

                $request['email'] = $alert->email;
                $alert->name = $request->name;
                $alert->industry_id = $request->industry_id;
                $alert->job_title = $request->title;
                $alert->city_id = $request->city_id;

                $seeker = Seeker::where('email', $request->email)->first();
                if($seeker){
                    $alert->is_seeker = 1;
                }

                $alert->save();

                return $this->success("Alert updated successfully");
            }else{
                return $this->error("Alert not found");
            }
        }catch (\Exception $exception){
            return $this->error($exception->getMessage());
        }

    }

}
