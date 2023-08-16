<?php

namespace App\Http\Controllers\Api\Mobile\Seeker\CvMaker;

use App\EducationSeeker;
use App\Flag;
use App\NotificationLogs;
use App\Seeker;
use App\SeekerCertification;
use App\SeekerExperience;
use App\SeekerProject;
use App\SeekerReference;
use App\Skills;
use App\TrackSeekerTemplates;
use App\Traits\ApiResponse;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SeekerCvMakerController extends Controller
{

    use ApiResponse;
    public function index(Request $request){

        $seekerIs = $request->seekerIs;

        try{

            $seeker = Seeker::find($seekerIs->id);

            $data['experiences'] = $seeker->experience;
            $data['projects'] = $seeker->projects;
            $data['certifications'] = $seeker->certifications;

            $seekers_skills = $seeker->skills;
            $data['seekers_skills_display'] = $seekers_skills;
            $data['educations'] = $seeker->education;

            $data['seekers_skills'] = explode(",", $seekers_skills);
            $data['references'] = $seeker->references;
            $skills = Skills::select("id","name")->get();
            $selected = explode(",", $seekers_skills);
            $selected_skill = [];

            foreach($skills as $skill){
                if(in_array($skill->id, $selected)){
                    $selected_skill[] = array( "value" => trim($skill->name));
                }
                $sk[] = array("id" => $skill->id , "value" => trim($skill->name));
            }
            $data['count'] = count($sk);
            $data['skills'] = json_encode($sk, JSON_FORCE_OBJECT);

            $data['selectedskills'] = json_encode($selected_skill);


            $data['seeker'] = $this->seekerResponse($seeker);

//            dd($seeker);

            return $this->success('Cvs', $data);

        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

    public function seekerResponse($seeker){

        $seeker = Seeker::with(['industry'])->find($seeker->id);
//        $seeker->hobbies = seeker_api_array($seeker->hobbies);
//        $seeker->languages = seeker_api_array($seeker->languages);
        $flag = Flag::find($seeker->country);
        if($flag){
            $seeker->country = $flag->name;
        }

        return $seeker;
    }


    public function save_summary(Request $request){

        $validator = Validator::make($request->all(), [
            'summary' => 'required',
        ]);

        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $key => $error){
                $response['errors'][$key] = $error;
            }
            return $this->error("Validation failed", $response);
        }

        $seeker = Seeker::find($request->seekerIs->id);

        $seeker->update($request->toArray());
        $seeker->profile_strength();

        return response()->json(['success'=> 'Record updated successfully']);

    }

    public function save_experience(Request $request){

        try{

            $validator = Validator::make($request->all(), [
                'job_title' => 'required',
                'company' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'description' => 'required',
                'job_city' => 'required',
                'job_country' => 'required',

            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }


            if($request->experience_id == ''){

                $request['seeker_id'] = $request->seekerIs->id;
                $experience = new SeekerExperience();
                $experience->create($request->toArray());

            }else{

                $experience = SeekerExperience::find($request->experience_id);
                if($experience && $experience->seeker_id == $request->seekerIs->id){
                    $experience->update($request->toArray());
                }else{
                    return $this->error("Experience Not Found");
                }

            }

            $seeker = Seeker::find($request->seekerIs->id);
            $seeker->profile_strength();

            return $this->success('Experience Saved');

        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }


    public function get_experience(Request $request){

        $id = $request->experience_id;
        $experience = SeekerExperience::find($id);
        if($experience && $experience->seeker_id == $request->seekerIs->id){
            $data['experience'] = $experience;

            return $this->success('Experience', $data);
        }else{
            return $this->error('No Experience Exists');
        }

    }

    public function delete_experience(Request $request){

        $id = $request->experience_id;
        $seekerIs = $request->seekerIs;
        $experience = SeekerExperience::find($id);
        $seeker = Seeker::find($seekerIs->id);


        if($experience && $experience->seeker_id == $request->seekerIs->id){
            $experience->delete();
            $seeker->profile_strength();

            return $this->success('Experience Deleted Successfully');
        }else{
            return $this->error('Experience does not exists');
        }



    }

    public function save_project(Request $request){


        try{
            $validator = Validator::make($request->all(), [
                'project_title' => 'required',
                'project_url' => 'required|url',
                'company' => 'required',
                'date_start' => 'required',
                'date_end' => 'required',
                'description' => 'required',
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }

            if($request->project_id == ''){
                $request['seeker_id'] = $request->seekerIs->id;
                $project = new SeekerProject();
                $project->create($request->toArray());
            }else{
                $project = SeekerProject::find($request->project_id);
                if($project && $project->seeker_id == $request->seekerIs->id){
                    $project->update($request->toArray());
                }else{
                    return $this->error("Project Not Found");
                }
            }
            $seeker = Seeker::find($request->seekerIs->id);
            $seeker->profile_strength();
            return $this->success('Project Saved Successfully');
            
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }


    public function get_project(Request $request){

        try{
            $id = $request->project_id;
            $project = SeekerProject::find($id);

            if($project && $project->seeker_id == $request->seekerIs->id){
                $data['project'] = $project;
                return $this->success("Project Info", $data);
            }else{
                $data['project'] = $project;
                return $this->error("Project does not exists");
            }
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

    public function delete_project(Request $request){

        try {
            $id = $request->project_id;

            $seeker_project = SeekerProject::find($id);

            $seeker = Seeker::find($request->seekerIs->id);
            if ($seeker_project && $seeker_project->seeker_id == $request->seekerIs->id) {
                $seeker_project->delete();
                $seeker->profile_strength();

                return $this->success("Project Deleted Successfully");
            } else {
                return $this->error("Project does not exists");
            }
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

    public function save_certification(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'certification_name' => 'required',
                'license_number' => 'required',
                'completion_date' => 'required',
                'end_date' => 'required',
                'certification_authority' => 'required',
                'certification_url' => 'required|url',
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }


            if($request->certification_id == ''){

                $request['seeker_id'] = $request->seekerIs->id;
                $certification = new SeekerCertification();
                $certification->create($request->toArray());

            }else{

                $certification = SeekerCertification::find($request->certification_id);
                if($certification && $certification->seeker_id == $request->seekerIs->id){
                    $certification->update($request->toArray());
                }else{
                    return $this->error("Certifications Not Found");
                }

            }
            $seeker = Seeker::find($request->seekerIs->id);
            $seeker->profile_strength();

            return $this->success("Certifications Saved Successfully");

        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }


    public function get_certification(Request $request){

        try{

            $id = $request->certification_id;
            $certification = SeekerCertification::find($id);

            if($certification && $certification->seeker_id == $request->seekerIs->id){
                $data['certification'] = $certification;
                return $this->success("Certification Info", $data);
            }else{
                return $this->error("Certification does not exists");
            }

        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

    public function delete_certification(Request $request){

        $id = $request->certification_id;
        $seeker_certification = SeekerCertification::find($id);

        if($seeker_certification && $seeker_certification->seeker_id == $request->seekerIs->id){
            $seeker_certification->delete();

            $seeker = Seeker::find($request->seekerIs->id);
            $seeker->profile_strength();

            return $this->success("Certificate Deleted Successfully");
        }else{
            return $this->success("Certificate does not exists");
        }

    }

    public function save_skills(Request $request){

        $skills = $request->skills;
        try{
            $ids_skill = $skills;

            $seeker = Seeker::find($request->seekerIs->id);

            $seeker->update(["skills" => $ids_skill]);
            $seeker->profile_strength();

            return $this->success("Skills Updated Successfully");
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }




    }

    public function save_hobbies(Request $request){

        try{
            $seeker = Seeker::find($request->seekerIs->id);

            $hobbies = seeker_api_array($request->hobbies);

            foreach ($hobbies as $hobby){
                $ha[] = array("value" => $hobby);

            }

            $seeker->hobbies = json_encode($ha);
            $seeker->save();
            return $this->success("Hobbies Updated Successfully");
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

    public function save_language(Request $request){

        try{
            $seeker = Seeker::find($request->seekerIs->id);

            $languages = seeker_api_array($request->languages_input);
            foreach ($languages as $language){
                $ha[] = array("value" => $language);
            }

            $seeker->languages = json_encode($ha);
            $seeker->save();
            $seeker->profile_strength();

            return $this->success("Language Updated Successfully");
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

    public function save_reference(Request $request){

        try{

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'company' => 'required',
                'email' => 'required|email',
                'contact_no' => 'required',
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }

            $seeker = Seeker::find($request->seekerIs->id);


            $request['seeker_id'] = $request->seekerIs->id;
            $reference = new SeekerReference();
            $reference->create($request->toArray());
            $seeker->profile_strength();

            return $this->success("Language Updated Successfully");
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }


    }

    public function delete_reference(Request $request){

        try{
            $id = $request->reference_id;
            $seeker_reference = SeekerReference::find($id);

            if($seeker_reference && $seeker_reference->seeker_id == $request->seekerIs->id){
                $seeker_reference->delete();

                $seeker = Seeker::find($request->seekerIs->id);
                $seeker->profile_strength();

                return $this->success("Deleted Successfully");

            }else{
                return $this->success("Reference does not exists");

            }
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }


    }


    public function seeking_job(Request $request){


        try{
            $seeker = Seeker::find($request->seekerIs->id);
            $status = '';
            if($seeker->seeking_job == 0){
                $seeker->seeking_job = 1;
                $status = 'Active';
            }else{
                $seeker->seeking_job = 0;
                $status = 'DeActivated';
            }
            $seeker->save();

            return $this->success("Job Seeking Status Updated to ". $status);
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }


    }



    //education
    public function save_education(Request $request){

        try{
            $validator = Validator::make($request->all(), [
                'school' => 'required',
                'degree' => 'required',
                'study_field' => 'required',
                'year' => 'required|integer',
                'grade' => 'required',
                'location' => 'required',
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }


            if($request->education_id == ''){

                $request['seeker_id'] = $request->seekerIs->id;
                $education = new EducationSeeker();
                $education->create($request->toArray());

            }else{

                $education = EducationSeeker::find($request->education_id);
                if($education && $education->seeker_id == $request->seekerIs->id){
                    $education->update($request->toArray());
                    return $this->success("Education Updated Successfully");
                }else{
                    return $this->error("Education does not Exists");
                }

            }

            $seeker = Seeker::find($request->seekerIs->id);
            $seeker->profile_strength();
            return $this->success("Education Saved Successfully");
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }


    public function get_education(Request $request){

        try{
            $id = $request->education_id;
            $education = EducationSeeker::find($id);

            if($education && $education->seeker_id == $request->seekerIs->id){
                $data['education'] = $education;
                return $this->success("Education Saved Successfully", $data);
            }else{
                return $this->error("Education does not exists");
            }
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

    public function delete_education(Request $request){

        try{
            $id = $request->education_id;
            $education = EducationSeeker::find($id);

            if($education && $education->seeker_id == $request->seekerIs->id){
                $education->delete();

                $seeker = Seeker::find($request->seekerIs->id);
                $seeker->profile_strength();

                return $this->success("Education Deleted Successfully");

            }else{
                return $this->error("Education does not exists");
            }
        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

    }

    public function check_availability(Request $request){

        $username = $request->username;
        $seeker = Seeker::where('username', $username)->first();
        $seeker_logged = Seeker::find($request->seekerIs->id);


        if($seeker){
            return $this->error("Username is taken");
        }else{
            $seeker_logged->username = $username;
            $seeker_logged->save();

            return $this->success("Available");
        }


    }

    public function cv_download(Request $request){

        $template = $request->template;
        $seeker = Seeker::find($request->seekerIs->id);

        if( $seeker->cv_download_inputs() ){
            $data['error'] = "Missing inputs are ". implode(",", $seeker->cv_download_inputs());
            return $this->error("Please complete your profile before proceeding", $data);
        }

        switch ($template){
            case 'template-1':
                $template = 'template-1';
                break;
            case 'template-2':
                $template = 'template-2';
                break;
            case 'template-3':
                $template = 'template-3';
                break;
            case 'template-4':
                $template = 'template-4';
                break;
            case 'template-5':
                $template = 'template-5';
                break;
            default:
                $template = 'template-1';
                break;
        }


        $experiences = $seeker->experience;
        $projects = $seeker->projects;
        $education = $seeker->education->first();
        $skills = $seeker->skills;
        $certifications = $seeker->certifications;
        $industry = $seeker->industry;
        $references = $seeker->references;

//        try{
            $pdf = PDF::loadview('frontend.seeker.cv-maker.pdf-templates.'.$template, compact('seeker', 'experiences','projects', 'education', 'skills','certifications','industry','references'));

//        }catch (\Exception $exception){
//            dd($exception->getMessage());
//        }

//        dd('asdasd');

        $track_template = TrackSeekerTemplates::where("template_name", $template)->first();
        if( !$track_template ){
            $track_template = new TrackSeekerTemplates();
        }
        $track_template->template_name = $template;
        $track_template->downloads = $track_template->downloads + 1;
        $track_template->save();

        NotificationLogs::create([
            "notifier_id" => $request->seekerIs->id,
            "notifier_type" => 'seeker',
            "message" => 'You Have downloaded your CV',
            "url" => "#",
        ]);

        $path = public_path('seekers/pdfs/' . getDomainRoot());

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $path = $path.$seeker->id.'cv.pdf';
        $pdf->save($path);

        $data['url'] = url('seekers/pdfs/'.getDomainRoot().$seeker->id.'cv.pdf');
        return $this->success("Download Link", $data);

    }

}
