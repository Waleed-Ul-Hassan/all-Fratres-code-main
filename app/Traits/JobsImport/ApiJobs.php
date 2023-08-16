<?php

namespace App\Traits\JobsImport;
use App\ActivityLogs;
use App\ApiJobsPaging;
use App\Job;

use App\Traits\ExternalJobs;
use App\WebStat;
use Illuminate\Support\Str;
use Request;


Trait ApiJobs {

        use ExternalJobs;
        private $activity_on = 'api_jobs';

        public function getWhatJobs(){


            $limit = 25;
            $website = 'what_jobs';
            $paging = ApiJobsPaging::whatJobs();
            if($paging == null){
                ApiJobsPaging::create([
                    'jobs_from'=> $website,
                    'current_page'=> 1,
                ]);
            }

            $paging = ApiJobsPaging::whatJobs();
            $total_today = $paging->current_page;
            $counter_times = $paging->current_page + 4;
            $count_job = 0;
            for ($i=$total_today;$i<=$counter_times;$i++) {

                $jobs = $this->WhatJobs('', '', '', $i, $limit);

                if ($jobs['status'] == 'success') {


                    $records = $jobs['data'];
//                                    dd($records->data);

                    try {


                        if (count($records->data) > 0) {

                            $expiry_date = date("Y-m-d", strtotime("+10 days"));

                            $slug[] = array();
                            $all_records[] = array();
                            foreach ($records->data as $record) {

                                $string_id = str_replace("pnpClick(this,'", "", $record->onmousedown);
                                $string_id = str_replace("');", "", $string_id);
//
//                                $get_job = Job::where('title', $record->title)
//                                    ->where("job_website", $website)
//                                    ->where("postcode_string", $record->postcode)
//                                    ->where("contract_type", $record->job_type)
//                                    ->where("expiry_date",">=", date("Y-m-d"))
//                                    ->count();
//
//                                if ($get_job > 0) {
//                                    continue;
//                                }

                                $slug[] = $record->url;
                                $all_records[] = array(
                                    'title' => $record->title,
                                    'slug' => $record->url,
                                    'contract_type' => $record->job_type,
                                    'postcode_string' => $record->postcode,
                                    'logo_string' => $record->logo,
                                    'description' => $record->snippet,
                                    'age_days' => $record->age_days,
                                    'location_string' => clean($record->location),
                                    'salary_string' => $record->salary,
                                    'company' => $record->company,
                                    'addition_params' => $record->onmousedown,
                                    'job_id_string' => $string_id,
                                    'expiry_date' => $expiry_date,
                                    'job_website' => $website,
                                    'job_status' => 'active',
                                    'is_external' => 1,
                                );
                                $count_job++;
                            }
                            $all_records = array_filter($all_records);
//                            dd($all_records);
                            if(count($all_records) > 0){
                                Job::insert($all_records);
                                $stats = WebStat::first();
                                if(!$stats){
                                    $stats = new WebStat();
                                }

                                $stats->total_jobs = $stats->total_jobs + count($all_records);
                                $stats->save();
                            }

                            if( $i == $counter_times ) {

                                $activity_log = new ActivityLogs();
                                $activity_log->log_type = "success";
                                $activity_log->activity_on = $this->activity_on;
                                $activity_log->message = "WhatJobs: Successfully imported (" . $count_job . ") jobs from WhatJobs";
                                $activity_log->save();
                            }

                        }else{

                            $paging->current_page = 1;
                            $paging->total_pages = null;
                            $paging->save();
                            break;
                        }

                    } catch (\Exception $e) {

                        $activity_log = new ActivityLogs();
                        $activity_log->log_type = "error";
                        $activity_log->activity_on = $this->activity_on;
                        $activity_log->message = "WhatJobs: Error Occured on Import ( " . $e->getMessage() . " )";
                        $activity_log->save();

                    }

                    $paging->current_page = $i;
                    $paging->total_pages = $records->last_page;
                    $paging->save();
                }

            }


        }


        public function getZipRecruiterJobs(){


//        pre($this->ZipRecruiterJobs('', '', '', 1, 100),1);

        $limit = 30;
//        $urls_here = array();
        $website = 'zip_recruiter';
        $paging = ApiJobsPaging::zip_recruiter();
        if($paging == null){
            ApiJobsPaging::create([
                'jobs_from'=> $website,
                'current_page'=> 1,
            ]);
        }

        $paging = ApiJobsPaging::zip_recruiter();
        $total_today = $paging->current_page;
        $counter_times = $paging->current_page + 6;
        $count_job = 0;
//            dd($counter_times .' - '. $total_today);
        for ($i=$total_today;$i<=$counter_times;$i++) {

            $jobs = $this->ZipRecruiterJobs('', '', '', $i, $limit);
//            dd($jobs);

            if ($jobs['status'] == 'success') {


                $records = $jobs['data'];


                try {

//                    dd($records);

                    if ($records->success == true && count($records->jobs) > 0) {

                        $expiry_date = date("Y-m-d", strtotime("+10 days"));


//                        dd($records->jobs);
                        $all_records = [];
                        $slug = [];
                        foreach ($records->jobs as $record) {

                            $string_id = $record->id;


//                            $get_job = Job::where('slug', $record->url)
//                                ->where("job_website", $website)
//                                ->count();
//
//                            if ($get_job > 0) {
//                                continue;
//                            }

                            $created = date("Y-m-d H:i:s", strtotime($record->posted_time));

                            if( $created < date("Y-m-d H:i:s", strtotime("-15 days")) ){
                                continue;
                            }

                            $salary = $record->salary_min .' - '. $record->salary_max. ' / '.$record->salary_interval;
//                            array_push($urls_here, $record->url);
                            $slug[] = $record->url;
                            $all_records[] = array(
                                'title' => $record->name,
                                'slug' => $record->url,
                                'description' => $record->snippet,
                                'age_days' => $record->job_age,
                                'location_string' => clean($record->location),
                                'salary_string' => $salary,
                                'company' => json_encode($record->hiring_company),
                                'addition_params' => null,
                                'job_id_string' => $string_id,
                                'expiry_date' => $expiry_date,
                                'job_website' => $website,
                                'category_string' => $record->category,
                                'created_at' => $created,
                                'job_status' => 'active',
                                'is_external' => 1,
                            );
                            $count_job++;
                        }
                        $jobs_all = Job::select("slug")->whereIn("slug", $slug)->limit(1000)->get()->toArray();
                        if(count($jobs_all) > 0){
                            foreach($all_records as $key => $value){
                                if(in_array($value['slug'], $jobs_all)) {
                                    unset($all_records[$key]);
                                }else{
                                    $all_records[] = $value;
                                }
                            }
                        }

//                        dd($all_records);


                        if(count($all_records) > 0){
                            Job::insert($all_records);
                            $stats = WebStat::first();
                            if(!$stats){
                                $stats = new WebStat();
                            }

                            $stats->total_jobs = $stats->total_jobs + count($all_records);
                            $stats->save();
                        }


                        if( $i == $counter_times ) {

                            $activity_log = new ActivityLogs();
                            $activity_log->log_type = "success";
                            $activity_log->activity_on = $this->activity_on;
                            $activity_log->message = "ZipRecruiter: Successfully imported (" . $count_job . ") jobs from ZipRecruiter";
                            $activity_log->save();
                        }

                    }else{

                        $paging->current_page = 1;
                        $paging->total_pages = null;
                        $paging->save();
                        break;
                    }

                } catch (\Exception $e) {

                    dd( $e->getMessage() );

                    $activity_log = new ActivityLogs();
                    $activity_log->log_type = "error";
                    $activity_log->activity_on = $this->activity_on;
                    $activity_log->message = "ZipRecruiter: Error Occured on Import ( " . $e->getMessage() . " - on ".$e->getLine(). " in File " . $e->getFile(). ")";
                    $activity_log->save();

                }

                $paging->current_page = $i;
                $paging->total_pages = $records->total_jobs / $limit;
                $paging->save();
            }

        }

//        dd($urls_here);
    }


        public function getAdZunaJobs(){


//        pre($this->AdzunaJobs(1000),1);

        $limit = 50;
        $website = 'adzuna_jobs';
        $paging = ApiJobsPaging::adzuna();
        if($paging == null){
            ApiJobsPaging::create([
                'jobs_from'=> $website,
                'current_page'=> 1,
            ]);
        }

        $paging = ApiJobsPaging::adzuna();
        $total_today = $paging->current_page;
        $counter_times = $paging->current_page + 5;
        $count_job = 0;
        for ($i=$total_today;$i<=$counter_times;$i++) {

            $jobs = $this->AdzunaJobs($i, $limit);


            if ($jobs['status'] == 'success') {


                $records = $jobs['data'];
                //                dd(count($records->data));

                try {


                    if (count($records->results) > 0) {

                        $expiry_date = date("Y-m-d", strtotime("+10 days"));
                        $add_job = new Job();
                        $slug = array();
                        foreach ($records->results as $record) {

                            $string_id = $record->id;


//                            $get_job = Job::where('slug', $record->redirect_url)
//                                ->where("job_website", $website)
//                                ->count();
//
//                            if ($get_job > 0) {
//                                continue;
//                            }

                            $created = date("Y-m-d H:i:s", strtotime($record->created));
                            if( $created < date("Y-m-d H:i:s", strtotime("-15 days")) ){
                                continue;
                            }

//                            dd($record->title);
                            $location = '';
                            $company = '';
                            $salary = '';
                            if(isset($record->salary_max) && ($record->salary_max != '')){
                                $salary = $record->salary_max;
                            }else{
                                if(isset($record->salary_min)){
                                    $salary = $record->salary_min;
                                }
                            }
                            if(isset($record->location) && ($record->location != '')){
                                if(isset($record->location->display_name)){
                                    $location = $record->location->display_name;
                                }
                            }
                            if(isset($record->company) && ($record->company != '')){
                                if(isset($record->company->display_name)){
                                    $company = $record->company->display_name;
                                }
                            }

                            $slug[] = $record->redirect_url;
                            $all_records[] = array(
                                'title' => $record->title,
                                'slug' => $record->redirect_url,
                                'description' => $record->description,
                                'location_string' => $location,
                                'salary_string' => $salary,
                                'company' => json_encode(array("name"=> $company)),
                                'addition_params' => null,
                                'job_id_string' => $string_id,
                                'expiry_date' => $expiry_date,
                                'job_website' => $website,
                                'category_string' => $record->category->label,
                                'created_at' => $created,
                                'job_status' => 'active',
                                'is_external' => 1,
                            );
                            $count_job++;
                        }
                        $jobs_all = Job::select("slug")->whereIn("slug", $slug)->limit(1000)->get()->toArray();
                        if(count($jobs_all) > 0){
                            foreach($all_records as $key => $value){
                                if(in_array($value['slug'], $jobs_all)) {
                                    unset($all_records[$key]);
                                }else{
                                    $all_records[] = $value;
                                }
                            }
                        }
                        Job::insert($all_records);
                        if(count($all_records) > 0){
                            $stats = WebStat::first();
                            if(!$stats){
                                $stats = new WebStat();
                            }

                            $stats->total_jobs = $stats->total_jobs + count($all_records);
                            $stats->save();
                        }

                        if( $i == $counter_times ) {

                            $activity_log = new ActivityLogs();
                            $activity_log->log_type = "success";
                            $activity_log->activity_on = $this->activity_on;
                            $activity_log->message = "AdZuna: Successfully imported (" . $count_job . ") jobs from AdZuna";
                            $activity_log->save();
                        }

                    }else{

                        $paging->current_page = 1;
                        $paging->total_pages = null;
                        $paging->save();
                        break;
                    }

                } catch (\Exception $e) {

                    $activity_log = new ActivityLogs();
                    $activity_log->log_type = "error";
                    $activity_log->activity_on = $this->activity_on;
                    $activity_log->message = "AdZuna: Error Occured on Import ( " . $e->getMessage() . " )";
                    $activity_log->save();

                }

                $paging->current_page = $i;
                $paging->total_pages = $records->count / $limit;
                $paging->save();
            }

        }


    }


        public function getCareerJetJobs(){


//        pre($this->CareerJetJobs('','',2),1);


        $website = 'career_jet';
        $paging = ApiJobsPaging::career_jet();
        if($paging == null){
            ApiJobsPaging::create([
                'jobs_from'=> $website,
                'current_page'=> 1,
            ]);
        }

        $expiry_date = date("Y-m-d", strtotime("+10 days"));
        $paging = ApiJobsPaging::career_jet();
        $total_today = $paging->current_page;
        $counter_times = $paging->current_page + 10;
        $count_job = 0;
        for ($i=$total_today;$i<=$counter_times;$i++) {

            $jobs = $this->CareerJetJobs('','', $i);

//            echo $i . '<br>';

            if ($jobs['status'] == 'success') {


                $records = $jobs['data'];
//                                dd(count($records->data));
//                dd($records);

                try {


                    if (count($records->jobs) > 0) {

                        $add_job = new Job();
                        $slug = array();
                        $jobs = $records->jobs;
                        $all_records = array();
//                        dd( $jobs );
                        foreach ($jobs as $record) {

                            $string_id = $i;
//                            if( isset($record->expiry_date) ){
//                                $expiry_date = $record->expiry_date;
//                            }

//                            $created = date("Y-m-d H:i:s", strtotime($record->created_at));
//                            if( $created < date("Y-m-d H:i:s", strtotime("-15 days")) ){
//                                continue;
//                            }


                            $salary = '';
                            if($record->salary != ''){
                                $salary = $record->salary;
                            }

                            $slug[] = $record->url;
                            $all_records[] = array(
                                'title' => $record->title,
                                'slug' => $record->url,
                                'description' => $record->description,
                                'location_string' => clean($record->locations),
                                'salary_string' => $salary,
                                'company' => json_encode(array("name"=>$record->company)),
                                'addition_params' => null,
                                'job_id_string' => $string_id,
                                'expiry_date' => $expiry_date,
                                'job_website' => $website,
                                'category_string' => null,
                                'created_at' => date("Y-m-d H:i:s"),
                                'job_status' => 'active',
                                'is_external' => 1,
                            );
                            $count_job++;
                        }
//                        dd( $slug );
//                        dd( $all_records );
                        $jobs_all = Job::select("slug")->where("job_website",$website)->whereIn("slug", $slug)->limit(1000)->get()->toArray();
                        if(count($jobs_all) > 0){
                            $all_records = [];
//                            dd( $jobs_all );
                            foreach($all_records as $key => $value){
                                if(in_array($value['slug'], $jobs_all)) {
                                    unset($all_records[$key]);
                                }else{
                                    $all_records[] = $value;
                                }
                            }
                        }
//                        dd( $all_records );

                        if(count($all_records) > 0){
                            Job::insert($all_records);
                            $stats = WebStat::first();
                            if(!$stats){
                                $stats = new WebStat();
                            }

                            $stats->total_jobs = $stats->total_jobs + count($all_records);
                            $stats->save();
                        }

                        if( $i == $counter_times ) {

                            $activity_log = new ActivityLogs();
                            $activity_log->log_type = "success";
                            $activity_log->activity_on = $this->activity_on;
                            $activity_log->message = "CareerJet: Successfully imported (" . $count_job . ") jobs from CareerJet";
                            $activity_log->save();
                        }

                    }else{
//                        dd( $jobs );
                        $paging->current_page = 1;
                        $paging->total_pages = null;
                        $paging->save();
                        break;
                    }

                } catch (\Exception $e) {

                    $activity_log = new ActivityLogs();
                    $activity_log->log_type = "error";
                    $activity_log->activity_on = $this->activity_on;
                    $activity_log->message = "CareerJet: Error Occured on Import ( " . $e->getMessage() . " )";
                    $activity_log->save();

                }

                $paging->current_page = $i;
                $paging->total_pages = $records->pages;
                $paging->save();
            }

        }


    }

        public function getJobToMeJobs(){


//        pre($this->JobtomeJobs(2),1);


        $website = 'jobto_me';
        $paging = ApiJobsPaging::jobto_me();
        if($paging == null){
            ApiJobsPaging::create([
                'jobs_from'=> $website,
                'current_page'=> 1,
            ]);
        }

        $paging = ApiJobsPaging::jobto_me();
        $total_today = $paging->current_page;
        $counter_times = $paging->current_page + 10;
        $count_job = 0;
        for ($i=$total_today;$i<=$counter_times;$i++) {

            $jobs = $this->JobtomeJobs($i);
//            dd($jobs);

            if ($jobs['status'] == 'success') {


                $records = $jobs['data'];
                //                dd(count($records->data));

                try {


                    if (count($records->results) > 0) {

                        $expiry_date = date("Y-m-d", strtotime("+10 days"));
                        $add_job = new Job();
                        $slug = array();
                        $all_records = array();
                        foreach ($records->results as $record) {

                            $string_id = $i;


//                            $get_job = Job::where('job_id_string', $record->company)
//                                ->where("title", $record->title)
//                                ->where("location_string", $record->location)
//                                ->where("job_website", $website)
//                                ->where("expiry_date",">=", date("Y-m-d"))
//                                ->count();
//
//                            if ($get_job > 0) {
//                                continue;
//                            }
                            $created = date("Y-m-d H:i:s", strtotime($record->date));
                            if( $created < date("Y-m-d H:i:s", strtotime("-15 days")) ){
                                continue;
                            }


                            $salary = ' - ';
                            $slug[] = $record->url;
                            $all_records[] = array(
                                'title' => $record->title,
                                'slug' => $record->url,
                                'description' => $record->description,
                                'location_string' => clean($record->location),
                                'salary_string' => $salary,
                                'company' => json_encode(array("name"=>$record->company)),
                                'addition_params' => $record->onmousedown,
                                'job_id_string' => $string_id,
                                'expiry_date' => $expiry_date,
                                'job_website' => $website,
                                'category_string' => null,
                                'created_at' => $created,
                                'job_status' => 'active',
                                'is_external' => 1,
                            );
                            $count_job++;
                        }
                        $jobs_all = Job::select("slug")->whereIn("slug", $slug)->limit(1000)->get()->toArray();
                        if(count($jobs_all) > 0){
                            foreach($all_records as $key => $value){
                                if(in_array($value['slug'], $jobs_all)) {
                                    unset($all_records[$key]);
                                }else{
                                    $all_records[] = $value;
                                }
                            }
                        }
                        if(count($all_records) > 0){
//                            dd( count($all_records) );
                            Job::insert($all_records);
                            $stats = WebStat::first();
                            if(!$stats){
                                $stats = new WebStat();
                            }

                            $stats->total_jobs = $stats->total_jobs + count($all_records);
                            $stats->save();
                        }

                        if( $i == $counter_times ) {

                            $activity_log = new ActivityLogs();
                            $activity_log->log_type = "success";
                            $activity_log->activity_on = $this->activity_on;
                            $activity_log->message = "JobtoMe: Successfully imported (" . $count_job . ") jobs from JobtoMe";
                            $activity_log->save();
                        }

                    }else{

                        $paging->current_page = 1;
                        $paging->total_pages = null;
                        $paging->save();
//                        echo 'here';
                        break;
                    }

                } catch (\Exception $e) {

                    $activity_log = new ActivityLogs();
                    $activity_log->log_type = "error";
                    $activity_log->activity_on = $this->activity_on;
                    $activity_log->message = "JobtoMe: Error Occured on Import ( " . $e->getMessage() . " on line ". $e->getLine() ." )";
                    $activity_log->save();

                }

                $paging->current_page = $i;
                $paging->total_pages = $records->response->max_page;
                $paging->save();
            }

        }


    }



}


?>
