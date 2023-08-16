<?php

namespace App\Http\Controllers\Seeker;

use App\AdminSetting;
use App\Applicant;
use App\Flag;
use App\Http\Requests\ValidateRequestsGeneric;
use App\Industry;
use App\Job;
use App\NotificationLogs;
use App\Recruiter;
use App\Seeker;
use App\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SeekerDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('seeker');

    }

    public function index(){

        $recdb = (new Recruiter())->getConnection()->getDatabaseName();
        $jobdb = (new Job())->getConnection()->getDatabaseName();


        $seeker = Seeker::find(Auth::guard('seeker')->user()->id);
        $applied_jobs = Applicant::where('seeker_id', $seeker->id)
                        ->leftJoin($jobdb.'.jobs',$jobdb.'.applicants.job_id',$jobdb.'.jobs.id')
                        ->leftJoin($recdb.'.recruiters',$jobdb.'.jobs.recruiter_id',$recdb.'.recruiters.id')
                        ->leftJoin($jobdb.'.cities',$jobdb.'.jobs.city',$jobdb.'.cities.id')
                        ->select($jobdb.'.jobs.title',$jobdb.'.jobs.slug',$recdb.'.recruiters.company_name',$recdb.'.recruiters.company_logo',$jobdb.'.cities.name',$jobdb.'.applicants.created_at',$jobdb.'.applicants.viewed_at',$jobdb.'.applicants.short_listed')
                        ->get();

//        dd($applied_jobs);

        return view('frontend.seeker.dashboard.index', compact('applied_jobs'));
    }

    public function profile(){

        $industries = Industry::select('name','id')->get();
        $flags =  Flag::all();
        $heading = "Update Profile";

        return view('frontend.seeker.profile.index', compact('industries', 'heading','flags'));
    }




    public function change_avatar(Request $request){


        $seeker = Seeker::find(Auth::guard('seeker')->user()->id);

        $image_path = public_path('seekers/profile/' . getDomainRoot().$seeker->avatar);
        $path = public_path('seekers/profile/' . getDomainRoot());

        if (!File::isDirectory($image_path)) {
            File::makeDirectory($image_path, 0777, true, true);
        }

        if($request->hasFile('fileToUpload')){

            $image = $request->file('fileToUpload');
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);

            if(in_array($ext, array("JPG", "JPEG", "jpg", "jpeg", "png", "PNG", "SVG", "svg"))){

                $filename = time() . '.' . $ext;
                $seeker->avatar = $filename;

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->save($path. $filename);
            }else{
                $notification = swal_alert_message_error("Oops!","Please Upload Valid JPG/PNG image","Okay","error");
                return redirect()->back()->with($notification);
            }


        }

        if($request->desired_job_title != ''){
             $seeker->desired_job_title =  $request->desired_job_title;
        }
        if($request->previous_job_title != ''){
             $seeker->previous_job_title =  $request->previous_job_title;
        }
        if($request->seeker_skills != ''){
             $seeker->skills =  $request->seeker_skills;
        }

        $seeker->save();
        $notification = swal_alert_message("Success","Image Updated Successfully","Okay","success");
        return redirect()->back()->with($notification);

    }

    public function updatePassword(){

        $heading = "Update Password";
//        dd('here');
        return view('frontend.seeker.profile.update-password', compact('heading'));
    }

    public function updatePasswords(ValidateRequestsGeneric $request){

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
        $message_notification = '';
        $seeker = Auth::guard('seeker')->user();
        $id = $seeker->id;
        $seeker = Seeker::find($id);

        if($seeker->is_social_login == 1){
            if ($request->password == $request->password_confirmation) {
//                dd($id);
                $seeker->password = $request->password;
                $seeker->is_social_login = 0;
                $seeker->save();
                $message_notification = "You Have Successfully Updated Password";
                $notification = swal_alert_message("Congratulations", 'You Have Successfully Updated Password', "Okay", 'success');
            }
        }else{
            $hashedPassword = $seeker->password;
            if (Hash::check($request->old_pass, $hashedPassword)) {
                if ($request->password == $request->password_confirmation) {
                    $seeker->password = $request->password;
                    $seeker->save();
                    $message_notification = "You Have Successfully Updated Password";
                    $notification = swal_alert_message("Congratulations", 'You Have Successfully Updated Password', "Okay", 'success');
                }else{
                    $message_notification = "Password and confirm password does not match";
                    $notification = swal_alert_message_error("Invalid Password","Password and confirm password does not match");
                }

            }else{
                $message_notification = 'Invalid Current Password';
                $notification = swal_alert_message_error("Invalid Password","Invalid Current Password");
            }
        }



        NotificationLogs::create([
            "notifier_id" => seeker_logged('id'),
            "notifier_type" => 'seeker',
            "message" => $message_notification,
            "url" => "#",
        ]);

        return redirect('/seeker/update-password')->with($notification);

    }

    public function account_update(Request $request){

        $path = public_path('seekers/cvs/' . getDomainRoot());

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }


        $seeker = Seeker::find(Auth::guard('seeker')->user()->id);
        $phone = array("phone"=> $request->phone, "phone_optional"=> $request->phone_optional);

        $seeker->first_name = $request->first_name;
        $seeker->last_name = $request->last_name;
        $seeker->gender = $request->gender;
        $seeker->city = $request->city;
        $seeker->country = $request->country;
        $seeker->postcode = $request->postcode;
        $seeker->phone = json_encode($phone);
        $seeker->available_job_type = implode(",", $request->available_job_type);;
        $seeker->current_job_title = $request->current_job_title;
        $seeker->current_company = $request->current_company;
        $seeker->industries = $request->industries;
        $seeker->expected_salary = $request->expected_salary;

        $seeker->experience_years = $request->experience_years;
        $seeker->martial_status = $request->martial_status;

        $seeker->career_level = $request->career_level;
        $seeker->website_portfolio = $request->website_portfolio;
        $seeker->relocate = $request->relocate;
        $seeker->dob = date("Y-m-d", strtotime($request->dob));



        if ($request->hasFile('cv_resume') ){
            $time = time().md5(time()).Str::limit(10);
            $imageName = $time . '.' . $request->cv_resume->getClientOriginalExtension();

            $file_path = $path.$seeker->cv_resume;
            if(File::exists($file_path)) {
                File::delete($file_path);
            }

            $request->cv_resume->move($path, $imageName);
            $seeker->cv_resume = $imageName;

        }

        $seeker->profile_strength();
        $seeker->save();
        $notification = swal_alert_message("Success","Record Updated Successfully","Okay","success");
        return back()->with($notification);

    }

    public function remove_cv(){

        $path = public_path('seekers/cvs/' . getDomainRoot());

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $seeker = Seeker::find(Auth::guard('seeker')->user()->id);
        $file_path = $path.$seeker->cv_resume;
        if(File::exists($file_path)) {
            File::delete($file_path);
        }

        $seeker->cv_resume = '';
        $seeker->save();

        $seeker->profile_strength();
        $seeker->save();

        $notification = swal_alert_message("Success","CV removed Successfully","Okay","success");
        return back()->with($notification);

    }


    public function invoices(){

        $seeker = Seeker::find(seeker_logged('id'));
        $orders = $seeker->orders()->latest()->paginate(25);
//        dd($orders);

        return view('frontend.seeker.invoices.index', compact('orders'));
    }


}
