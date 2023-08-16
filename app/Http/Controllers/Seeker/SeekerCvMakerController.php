<?php

namespace App\Http\Controllers\Seeker;

use App\EducationSeeker;
use App\Industry;
use App\NotificationLogs;
use App\Seeker;
use App\SeekerCertification;
use App\SeekerExperience;
use App\SeekerProject;
use App\SeekerReference;
use App\Skill;
use App\Skills;
use App\TrackSeekerTemplates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use PDF;

class SeekerCvMakerController extends Controller
{

    public function __construct()
    {
        $this->middleware('seeker');

    }

    public function index(){
        // die();

        $seeker = Seeker::find(seeker_logged('id'));
        $data['experiences'] = $seeker->experience;
        $data['projects'] = $seeker->projects;
        $data['certifications'] = $seeker->certifications;

        $seekers_skills = $seeker->skills;
        $data['seekers_skills_display'] = $seekers_skills;
        $data['educations'] = $seeker->education;

        $data['seekers_skills'] = explode(",", $seekers_skills);
        $data['references'] = $seeker->references;
        $data['industries'] = Industry::orderBy("name", "ASC")->get();

//        $seeker->hobbies = json_decode($seeker->hobbies);
        $data['seeker'] = $seeker;

        if(ip() == '39.53.135.47'){
//            dd($seeker);
        }


        $skills = Skills::select("id","name")->get();
        $selected = explode(",", $seekers_skills);
        $selected_skill = [];

        foreach($skills as $skill){
            $sk[] = array("id" => $skill->id , "value" => trim($skill->name));
        }
        if(is_array($selected)){
            foreach($selected as $skill){
                $selected_skill[] = array( "value" => $skill);
            }
        }

        $data['count'] = count($sk);
        $data['skills'] = json_encode($sk, JSON_FORCE_OBJECT);

        $data['selectedskills'] = json_encode($selected_skill);

        return view('frontend.seeker.cv-maker.index', $data);

    }


    public function update_account(Request $request){

        if($request->has('first_name')) {

            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'dob' => 'required',
                'city' => 'required',
                'country' => 'required',
                'experience_years' => 'required',
                'current_job_title' => 'required',
                'current_company' => 'required',
                'expected_salary' => 'required',

            ]);

        }

        if($request->has('summary')){

            $validator = Validator::make($request->all(), [
                'summary' => 'required',
            ]);

        }

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

//        dd( $request->toArray() );

        $seeker = Seeker::find(seeker_logged('id'));

        $seeker->update($request->toArray());
        $seeker->profile_strength();

        return response()->json(['success'=> 'Record updated successfully']);

    }


    public function save_experience(Request $request){

        $validator = Validator::make($request->all(), [
            'job_title' => 'required',
            'company' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'description' => 'required',
            'job_city' => 'required',
            'job_country' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }


        if($request->experience_id == ''){

            $request['seeker_id'] = seeker_logged('id');
            $experience = new SeekerExperience();
            $experience->create($request->toArray());

        }else{

            $experience = SeekerExperience::find($request->experience_id);
            $experience->update($request->toArray());

        }

        $seeker = Seeker::find(seeker_logged('id'));
        $seeker->profile_strength();

    }


    public function get_experience($id){

        $experience = SeekerExperience::find($id);

        if($experience){
            return $experience;
        }else{
            return response()->json(['error'=> 'Experience does not exists']);
        }

    }

    public function delete_experience($id){

        $experience = SeekerExperience::find($id);

        $seeker = Seeker::find(seeker_logged('id'));


        if($experience){
            $experience->delete();
            $seeker->profile_strength();

            return response()->json(['success'=> 'Deleted Successfully']);
        }else{
            return response()->json(['error'=> 'Experience does not exists']);
        }



    }

    public function save_project(Request $request){

        $validator = Validator::make($request->all(), [
            'project_title' => 'required',
            'project_url' => 'required|url',
            'company' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'description' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }


        if($request->project_id == ''){

            $request['seeker_id'] = seeker_logged('id');
            $experience = new SeekerProject();
            $experience->create($request->toArray());

        }else{

            $experience = SeekerProject::find($request->project_id);
            $experience->update($request->toArray());

        }

        $seeker = Seeker::find(seeker_logged('id'));
        $seeker->profile_strength();

        return response()->json(['success'=> 'Project Saved Successfully']);
    }


    public function get_project($id){

        $project = SeekerProject::find($id);

        if($project){
            return $project;
        }else{
            return response()->json(['error'=> 'Experience does not exists']);
        }

    }

    public function delete_project($id){

        $seeker_project = SeekerProject::find($id);

        $seeker = Seeker::find(seeker_logged('id'));


        if($seeker_project){
            $seeker_project->delete();
            $seeker->profile_strength();

            return response()->json(['success'=> 'Deleted Successfully']);
        }else{
            return response()->json(['error'=> 'Experience does not exists']);
        }

    }

public function save_certification(Request $request){

        $validator = Validator::make($request->all(), [
            'certification_name' => 'required',
            'license_number' => 'required',
            'completion_date' => 'required',
            'end_date' => 'required',
            'certification_authority' => 'required',
            'certification_url' => 'required|url',


        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }


        if($request->certification_id == ''){

            $request['seeker_id'] = seeker_logged('id');
            $experience = new SeekerCertification();
            $experience->create($request->toArray());

        }else{

            $experience = SeekerCertification::find($request->certification_id);
            $experience->update($request->toArray());

        }
            $seeker = Seeker::find(seeker_logged('id'));
            $seeker->profile_strength();

            return response()->json(['success'=> 'Certifications Saved Successfully']);
    }


    public function get_certification($id){

        $certification = SeekerCertification::find($id);

        if($certification){
            return $certification;
        }else{
            return response()->json(['error'=> 'Certification does not exists']);
        }

    }

    public function delete_certification($id){

        $seeker_certification = SeekerCertification::find($id);

        if($seeker_certification){
            $seeker_certification->delete();

            $seeker = Seeker::find(seeker_logged('id'));
            $seeker->profile_strength();

            return response()->json(['success'=> 'Deleted Successfully']);
        }else{
            return response()->json(['error'=> 'Experience does not exists']);
        }

    }

    public function save_skills(Request $request){

        $skills = json_decode($request->skills);

        $ids_skill = array();
        foreach($skills as $skill){
            $ids_skill[] =  $skill->value;
        }

//        if(ip() == '39.53.102.165'){
//            dd( implode(",", $ids_skill) );
//            dd( $ids_skill );
//        }
        $ids_skill = implode(",", $ids_skill);

        $seeker = Seeker::find(seeker_logged('id'));

        $seeker->update(["skills" => $ids_skill]);

//        $skills = Skill::WhereIn("id",$ids_skill)->pluck('id')->toArray();
       // dd($skills);
       // dd($seeker);
        // try{
            // dd( $skills, $seeker->skills() );
//            $seeker->skills()->sync($skills);
        $seeker->profile_strength();

        // }catch(Exception $e){
        //     dd( $e->getMessage() );
        // }

            return response()->json(['success'=> 'Skills Updated Successfully']);



    }

    public function save_hobbies(Request $request){

//        dd($request->hobbies);

        $seeker = Seeker::find(seeker_logged('id'));
        $seeker->hobbies = $request->hobbies;
        $seeker->save();


        return response()->json(['success'=> 'Hobbies Updated Successfully']);

    }

    public function save_language(Request $request){

        $seeker = Seeker::find(seeker_logged('id'));
        $seeker->languages = $request->languages_input;
        $seeker->save();


        $seeker->profile_strength();

        return response()->json(['success'=> 'Language Updated Successfully']);

    }

    public function save_reference(Request $request){



        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'company' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        $seeker = Seeker::find(seeker_logged('id'));


            $request['seeker_id'] = seeker_logged('id');
            $reference = new SeekerReference();
            $reference->create($request->toArray());
            $seeker->profile_strength();

        return response()->json(['success'=> 'Reference Added Successfully']);

    }

    public function delete_reference($id){


        $seeker_reference = SeekerReference::find(decrypt($id));

        if($seeker_reference){
            $seeker_reference->delete();

            $seeker = Seeker::find(seeker_logged('id'));
            $seeker->profile_strength();

            return response()->json(['success'=> 'Deleted Successfully']);
        }else{
            return response()->json(['error'=> 'Reference does not exists']);
        }


    }


    public function seeking_job(){


        $seeker = Seeker::find(seeker_logged('id'));

        if($seeker->seeking_job == 0){
            $seeker->seeking_job = 1;
        }else{
            $seeker->seeking_job = 0;
        }
        $seeker->save();


    }



    //education
    public function save_education(Request $request){

        $validator = Validator::make($request->all(), [
            'school' => 'required',
            'degree' => 'required',
            'study_field' => 'required',
            'year' => 'required|integer',
            'grade' => 'required',
            'location' => 'required',


        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }


        if($request->education_id == ''){

            $request['seeker_id'] = seeker_logged('id');
            $education = new EducationSeeker();
            $education->create($request->toArray());

        }else{

            $education = EducationSeeker::find($request->education_id);
            $education->update($request->toArray());

        }

        $seeker = Seeker::find(seeker_logged('id'));
        $seeker->profile_strength();

        return response()->json(['success'=> 'Education Saved Successfully']);
    }


    public function get_education($id){

        $education = EducationSeeker::find($id);

        if($education){
            return $education;
        }else{
            return response()->json(['error'=> 'Education does not exists']);
        }

    }

    public function delete_education($id){

        $education = EducationSeeker::find($id);

        if($education){
            $education->delete();

            $seeker = Seeker::find(seeker_logged('id'));
            $seeker->profile_strength();

            return response()->json(['success'=> 'Deleted Successfully']);
        }else{
            return response()->json(['error'=> 'Education does not exists']);
        }

    }

    public function check_availability($username){

        $seeker = Seeker::where('username', $username)->first();
        $seeker_logged = Seeker::find(seeker_logged('id'));


        if($seeker){
            return response()->json(['error'=> 'Username is taken']);
        }else{
            $seeker_logged->username = $username;
            $seeker_logged->save();

            return response()->json(['success'=> 'Available']);
        }


    }

    public function cv_download($template){

        $seeker = Seeker::find(seeker_logged('id'));

        if( $seeker->cv_download_inputs() ){
            return redirect()->back()->with(swal_alert_message_error("Please complete your profile before proceeding", "Missing inputs are". implode(",", $seeker->cv_download_inputs())));
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

//         dd($skills);

        $pdf = PDF::loadview('frontend.seeker.cv-maker.pdf-templates.'.$template, compact('seeker', 'experiences','projects', 'education', 'skills','certifications','industry','references'));


        $track_template = TrackSeekerTemplates::where("template_name", $template)->first();
        if( !$track_template ){
            $track_template = new TrackSeekerTemplates();
        }
        $track_template->template_name = $template;
        $track_template->downloads = $track_template->downloads + 1;
        $track_template->save();

        NotificationLogs::create([
            "notifier_id" => seeker_logged('id'),
            "notifier_type" => 'seeker',
            "message" => 'You Have downloaded your CV',
            "url" => "#",
        ]);

//        return view('frontend.seeker.cv-maker.pdf-templates.'.$template, compact('seeker', 'experiences','projects', 'education', 'skills','certifications','industry','references'));
//        return $pdf->stream('frontend.seeker.cv-maker.pdf-templates.'.$template, compact('seeker', 'experiences','projects', 'education', 'skills','certifications','industry','references'));
        return $pdf->download("cv.pdf");

    }


}
