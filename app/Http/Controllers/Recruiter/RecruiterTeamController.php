<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Requests\ValidateRequestsGeneric;
use App\Recruiter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruiterTeamController extends Controller
{

    public function index(){
        $members = Recruiter::where("parent", recruiter_logged('id'))->orderBy('id','desc')->get();
        return view('frontend.recruiter.team.index', compact('members'));

    }

    public function add(){

        return view('frontend.recruiter.team.add');

    }

    public function create(ValidateRequestsGeneric $request){

        $data = $request->validate([
            'team_name' => 'required',
            'team_position' => 'required',
            'email' => 'required|unique:recruiters|email',
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

        $data['parent'] = recruiter_logged('id');
        $data['email'] = $request->email;
        $data['creator_position'] = $request->team_position;
        $data['creator_name'] = $request->team_name;
        $data['password'] = $request->password;
        $data['confirm_email_random_id'] = \Illuminate\Support\Str::random(35);


        $recruiter = Recruiter::create($data);

        if(env("APP_SEND_EMAIL") != 'local'){

        $subject = "Confirm Email";
        $mesg = view('frontend.emails.recruiter_confirm_signup', compact('recruiter'))->render();
        verify_email($recruiter->email, $subject, $mesg, "", "noreply@fratres.net");
        }


        return redirect()->back()->with(swal_alert_message("Congrats","Team Member is added successfully", "Okay","success"));

    }

    public function delete($id){

        $recruiter = Recruiter::find($id);
        if($recruiter->parent == recruiter_logged('id')){
            $recruiter->delete();
        }

        return redirect()->back()->with(swal_alert_message("Congrats", "Member is Deleted","Okay", 'success'));

    }




}
