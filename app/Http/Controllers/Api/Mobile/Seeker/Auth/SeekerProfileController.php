<?php

namespace App\Http\Controllers\Api\Mobile\Seeker\Auth;

use App\Flag;
use App\NotificationLogs;
use App\Seeker;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SeekerProfileController extends Controller
{
    use ApiResponse;

    public function change_avatar(Request $request){

        try{

            $seeker = Seeker::find($request->seekerIs->id);

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
                    return $this->error("Please Upload Valid JPG/PNG image");

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

            $data['avatar'] = $seeker->avatar;

            return $this->success("Image Updated Successfully", $data);

        }catch (\Exception $exception){
            return $this->error($exception->getMessage());
        }

    }



    public function updatePassword(Request $request){

        try {

            $error = FALSE;
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'confirmed', 'string', 'min:4', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }

            $message_notification = '';

            $seeker = $request->seekerIs;
            $seeker = Seeker::find($seeker->id);

            if ($seeker->is_social_login == 1) {
                $seeker->password = $request->password;
                $seeker->is_social_login = 0;
                $seeker->save();
                $message_notification = "You Have Successfully Updated Password";
            } else {
                $hashedPassword = $seeker->password;
                if (Hash::check($request->old_pass, $hashedPassword)) {
                    $seeker->password = $request->password;
                    $seeker->save();
                    $message_notification = "You Have Successfully Updated Password";
                } else {
                    $error = TRUE;
                    $message_notification = "Invalid Current Password";
                }
            }

            NotificationLogs::create([
                "notifier_id" => $seeker->id,
                "notifier_type" => 'seeker',
                "message" => $message_notification,
                "url" => "#",
            ]);

            if ($error) {
                return $this->error("Invalid Current Password");
            } else {
                return $this->success("You Have Successfully Updated Password");
            }

        }catch (\Exception $exception){
            return $this->error($exception->getMessage());
        }



    }

    public function account_update(Request $request){

        $path = public_path('seekers/cvs/' . getDomainRoot());

        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'gender' => ['required'],
            'city' => ['required'],
            'current_job_title' => ['required'],
        ]);

        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $key => $error){
                $response['errors'][$key] = $error;
            }
            return $this->error("Validation failed", $response);
        }

        try{

            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $seeker = $request->seekerIs;
            $seeker = Seeker::find($seeker->id);
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



            $data['seeker'] = $this->seekerResponse($seeker);

            return $this->success('Record Updated Successfully', $data);

        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
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

    public function remove_cv(Request $request){

        $path = public_path('seekers/cvs/' . getDomainRoot());

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        try{

            $seeker = $request->seekerIs;

            $seeker = Seeker::find($seeker->id);
            $file_path = $path.$seeker->cv_resume;
            if(File::exists($file_path)) {
                File::delete($file_path);
            }

            $seeker->cv_resume = '';
            $seeker->save();

            $seeker->profile_strength();
            $seeker->save();

            return $this->success('CV removed Successfully');

        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

}
