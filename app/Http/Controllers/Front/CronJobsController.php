<?php

namespace App\Http\Controllers\Front;

use App\AccountRecruiter;
use App\AccountSeeker;
use App\ActivityLogs;
use App\Admin;
use App\AdminSetting;
use App\AllJobsStats;
use App\Applicant;
use App\Blog;
use App\City;
use App\CompanyReview;
use App\ContactUs;
use App\Coupon;
use App\EducationSeeker;
use App\EmailStat;
use App\Flag;
use App\Industry;
use App\Job;
use App\JobAlert;
use App\Jobs\SendAlerts;
use App\JobStat;
use App\Order;
use App\Recruiter;
use App\RecruiterDownload;
use App\Seeker;
use App\SeekerCertification;
use App\SeekerExperience;
use App\SeekerProject;
use App\SeekerReference;
use App\WebStat;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Traits\JobsImport\ApiJobs;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tightenco\Collect\Support\LazyCollection;

class CronJobsController extends Controller
{
    use ApiJobs;

    public function email_test(){

//        $filename = File::get(public_path('frontend/af.json'));
        $cities = City::all();

        foreach ($cities as $city){

//            $city->name = str_replace('-',' ', ucfirst($city->city_slug));
//            $city->save();

//            dd($city);
//            dd($city);
//            City::updateOrCreate(
//                [
//                    "city_slug" => Str::slug($city->city)
//                ],
//                [
//                    "lat" => $city->lat,
//                    "lng" => $city->lng,
//                    "name" => $name,
//                    "total_jobs" => 0
//                ]
//            );
        }



        die();


//        verify_email("saqlainbukhari26@gmail.com", "SUbject", "Hi", "", "noreply@fratres.net");
//        die();

        $seeker = Seeker::where("email", "saqlainbukhari26@gmail.com")->first();
//        dd( $seeker );
        return view('frontend.emails.coupon_applied', compact('seeker'));
//        return view('frontend.emails.email');
        try{

            $data['seeker'] = Seeker::where("email", "saqlainbukhari26@gmail.com")->first();

            session(['email' => "saqlainbukhari26@gmail.com"]);
            session(['subject' => 'Product Request Cancelled - ReviewClerks']);

            Mail::send('frontend.emails.seeker_confirm_signup', $data , function($message){
                $message->to(session('email'))
                    ->subject(session('subject'));
            });
        }catch (Exception $e){
            dd( $e->getMessage() );
        }


    }

    public function email_infoIs($to) {

        $domain = "uk";
        $data = array(
            "sender" => array("name" => "Test", "email" => "rehan@test.com"),
            "to" => $to,
            "subject" => "got this?",
            "htmlContent" => "testing",
            "tags" => ["uk"]
        );
        return json_encode($data);

    }

    public function mail_sendinblueIs($msg) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Api-Key: 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';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;

    }

    public function addColoumn(){
//
//        $industries = array("Solicitor", "Trainee Solicitor", "Paralegal" , "Fee Earner" , "Consultant" );
//
//        foreach ($industries as $industry){
//            Industry::updateOrCreate([
//                'total_jobs' => 0,
//                'name' => $industry,
//                'industry_slug' => Str::slug($industry),
//            ]);
//        }


         DB::statement(' ALTER TABLE `admin_settings` ADD `app_settings` TEXT NULL AFTER `website_is_free` ');
         die();
//         DB::statement(' ALTER TABLE `company_reviews` CHANGE `employee_type` `employee_type` VARCHAR(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL ');
//         DB::statement(' ALTER TABLE `company_reviews` CHANGE `comments` `comments` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL ');
//         DB::statement(' ALTER TABLE `company_reviews` CHANGE `comments` `comments` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL ');
//            die();
//        $recruiters = Recruiter::select("company_name", "company_logo","cities.name as cname", "recruiters.id")
//            ->leftjoin('cities', 'cities.id', 'recruiters.city')->get();
//        foreach ($recruiters as $recruiter){
//           $recruiter->company_slug = $recruiter->createSlug($recruiter->company_name, $recruiter->cname, $recruiter->id);
//           $recruiter->save();
//        }
//        ALTER TABLE `admin_settings` ADD `app_settings` TEXT NULL AFTER `website_is_free`

            $flag = Flag::all();

           foreach ($flag as $f){
               echo "<a href='https://".$f->url."/cron/addColoumn'>".$f->url."</a> <br>";
           }

//        dd($next);
    }

    public function updateOrders(){
        $orders = Order::whereRaw("job_id IS NOT NULL")->get();

        foreach($orders as $order){
            $job = Job::find($order->job_id);
            if($job){
                $order->job_details = $job;
                $order->save();
            }
        }
    }


    public function updateAll(){
        $settings = AdminSetting::first();
        $settings->linkdin = 'https://www.linkedin.com/company/fratres-net/';
        $settings->save();
    }


    public function CallUrl($url){
        $flags = Flag::get();
        foreach($flags as $flag){
             // create curl resource
            $ch = curl_init();
            // set url
            curl_setopt($ch, CURLOPT_URL, $url);
            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // $output contains the output string
            $output = curl_exec($ch);
            // close curl resource to free up system resources
            curl_close($ch);
        }
    }

    public function blogs(){

//        dd('asd');

       $blogs = Blog::get();
       $counter = 0;
       foreach ($blogs as $blog){

           if($counter == 0){
               $counter++;
               continue;
           }

           $replace = 'https://pk.fratres.net/career-advice/';
           $search = 'https://pk.fratres.net/blog-detail/';
//
           $blog->description = str_replace($search, $replace, $blog->description);
           $blog->save();

//           dd( $blog->description );
//           echo "<pre>";
//           print_r( str_replace($search, $replace, $blog->description) );
//           die();

           $urls = preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $blog->description, $match);



//           $replace = 'https://'.$blog->country.'.fratres.net/career-advice/';
//           $search = 'https://in.fratres.net/blog/blog-detail/';
//
//           foreach ($match as $matchs){
//               foreach ($matchs as $value){
//                   echo str_replace($search, $replace, $value);
//                   echo  "<br>";
//               }
//           }

//           echo $blog->description . '<br>';

//           echo "<pre>";
//           print_r($match);
//        die();
//           $counter++;
       }

    }

    public function import_files(){

//        DB::statement(" ALTER TABLE `jobs` ADD `ip_origin` TEXT NULL AFTER `category_string` ");
//        dd('');
//
//        $recs = Recruiter::where("country_signed", getsubDomain())->get();
//        foreach ($recs as $rec){
//            $jobs = Job::where("recruiter_id", $rec->id)->where("job_status", "active")->count();
//            $rec->update(["total_jobs" => $jobs]);
//        }
//        dd('asd');
        $recruiter = Recruiter::find(52);
        Auth::guard('recruiter')->login($recruiter);
        return redirect('recruiter/dashboard');
        dd('asd');

        $seeker = Seeker::find(15);
        Auth::guard('seeker')->login($seeker);
        return redirect('seeker/dashboard');
        dd('asd');



        $subdomain = array_first(explode('.', request()->getHost()));

        $country_is = [];
//        $recruiters = Recruiter::all();
        $recruiters = Recruiter::all();
        foreach ($recruiters as $recruiter){
            $cc = (array) json_decode($recruiter->country_is);

            if($cc){

                $recruiter->country_signed = array_key_first($cc);
                $recruiter->save();
            }

//            $re = AccountRecruiter::where("email", $recruiter->email)->first();
//            if($re){
//                $country_is_array = (array) json_decode($re->country_is);
//                $country_is = (array) json_decode($re->country_is);
//
//                foreach ($country_is_array as $key => $item){
//                    if($key != $subdomain){
//                        $country_is[$subdomain] = $recruiter->id;
//                    }
//                }
//            }else{
//                $country_is = array($subdomain => $recruiter->id);
//            }
//            $country_is = json_encode($country_is);
//            $recruiter->country_is = $country_is;
//            $recruiter->original_id = $recruiter->id;
//            $check = array("email" => $recruiter->email);
//            $data = $recruiter->toArray();
//            AccountRecruiter::updateOrCreate($check,$data);


            //update ids
//            $country_is = (array) json_decode($recruiter->country_is);
//            if($country_is){
//                if(array_key_exists($subdomain, $country_is)){
//                    $original_id = $country_is[$subdomain];

//                    Job::where("recruiter_id", $original_id)->update(["recruiter_id" => $recruiter->id]);
//                    CompanyReview::where("company_id", $original_id)->update(["company_id" => $recruiter->id]);
//                    ContactUs::where("recruiter_id", $original_id)->update(["recruiter_id" => $recruiter->id]);
//                    Order::where("recruiter_id", $original_id)->update(["recruiter_id" => $recruiter->id]);
//                    RecruiterDownload::where("recruiter_id", $original_id)->update(["recruiter_id" => $recruiter->id]);

//                }

//            }

//            dd('out');

            //revert updated ids
//            CompanyReview::where("company_id", $recruiter->id)->update(["company_id" => $original_id]);
//            ContactUs::where("recruiter_id", $recruiter->id)->update(["recruiter_id" => $original_id]);
//            Order::where("recruiter_id", $recruiter->id)->update(["recruiter_id" => $original_id]);
//            RecruiterDownload::where("recruiter_id", $recruiter->id)->update(["recruiter_id" => $original_id]);

        }
//        dd('asdd');
        $seekers = Seeker::all();
        $country_is_seekr = [];
//        $seekers = AccountSeeker::all();
//        dd($seekers);
        foreach ($seekers as $seeker){

            $cc = (array) json_decode($seeker->country_is);

            if($cc){

                $seeker->country_signed = array_key_first($cc);
                $seeker->save();
            }

//            $re = AccountSeeker::where("email", $seeker->email)->first();
//            if($re){
//                $country_is_array = (array) json_decode($re->country_is);
//                $country_is_seekr = (array) json_decode($re->country_is);
//                foreach ($country_is_array as $key => $item){
//                    if($key != $subdomain){
//                        $country_is_seekr[$subdomain] = $seeker->id;
//                    }
//                }
//            }else{
//                $country_is_seekr = array($subdomain => $seeker->id);
//            }
//            $country_is_seekr = json_encode($country_is_seekr);
//
//            $seeker->country_is = $country_is_seekr;
//            $seeker->original_id = $seeker->id;
//
//            $check = array("email" => $seeker->email);
//            $data = $seeker->toArray();
//            AccountSeeker::updateOrCreate($check,$data);

            //updated ids
//            $country_is_seekr = (array) json_decode($seeker->country_is);
//            if($country_is_seekr){
//                if(array_key_exists($subdomain, $country_is_seekr)){
//                    $original_id_seeker = $country_is_seekr[$subdomain];
//
//                    Applicant::where("seeker_id", $original_id_seeker)->update(["seeker_id" => $seeker->id]);
//                    EducationSeeker::where("seeker_id", $original_id_seeker)->update(["seeker_id" => $seeker->id]);
//                    RecruiterDownload::where("seeker_id", $original_id_seeker)->update(["seeker_id" => $seeker->id]);
//                    SeekerCertification::where("seeker_id", $original_id_seeker)->update(["seeker_id" => $seeker->id]);
//                    SeekerExperience::where("seeker_id", $original_id_seeker)->update(["seeker_id" => $seeker->id]);
//                    SeekerProject::where("seeker_id", $original_id_seeker)->update(["seeker_id" => $seeker->id]);
//                    SeekerReference::where("seeker_id", $original_id_seeker)->update(["seeker_id" => $seeker->id]);
//
//                }
//
//            }




            //revert updated ids
//            Applicant::where("seeker_id", $seeker->id)->update(["seeker_id" => $original_id_seeker]);
//            EducationSeeker::where("seeker_id", $seeker->id)->update(["seeker_id" => $original_id_seeker]);
//            RecruiterDownload::where("seeker_id", $seeker->id)->update(["seeker_id" => $original_id_seeker]);
//            SeekerCertification::where("seeker_id", $seeker->id)->update(["seeker_id" => $original_id_seeker]);
//            SeekerExperience::where("seeker_id", $seeker->id)->update(["seeker_id" => $original_id_seeker]);
//            SeekerProject::where("seeker_id", $seeker->id)->update(["seeker_id" => $original_id_seeker]);
//            SeekerReference::where("seeker_id", $seeker->id)->update(["seeker_id" => $original_id_seeker]);

        }





        dd('asd');
//        try{
//            $duplicateRecords = DB::table('job_alerts')
//                ->select('email','id', DB::raw('count(`email`) as emails'))
//                ->where('id', '>', 120333)
//                ->groupBy('email')
//                ->having('emails', '>', 1)
//                ->get();
//
//            foreach ($duplicateRecords as $duplicateRecord){
//                JobAlert::where('id', $duplicateRecord->id)->delete();
//            }
//
//        }catch (\Exception $e){
//            dd( $e->getMessage() );
//        }
//
//        dd( $duplicateRecords );
//        die();
//        echo $filename = public_path('emails_import/80k_UK_Business_email_list.csv');

        LazyCollection::make(function () {
             $filename = public_path('emails_import/import.txt');

            $handle = fopen($filename, 'r');

//            dd($handle);

            while (($line = fgets($handle)) !== false) {
                yield $line;
            }
        })->chunk(30000)->map(function ($lines) {

            $entries = $lines->source;
//            $entries = explode("\n", $entries[0]);
            $entries = array_unique($entries);
//            dd($entries);

            $all_records = array();
            foreach ($entries as $entry){

                $email = str_replace(",", "", $entry);
                $email = str_replace("\n", "", $email);

                $all_records[] = array(
                    'email' => $email,
                    'job_title' => 'e',
                    'city_id' => null,
                    'industry_id' => null,
                    'is_seeker' => 0,
                    'random_id' => Str::random(50),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                );
            }
//            dd($all_records);
            try{
                JobAlert::insert($all_records);

            }catch (\Exception $e){
                dd( $e->getMessage() );
            }


        })->each(function ($lines) {
//            dd( $lines );
        });

    }

    public function add_indexes(){

        DB::select('ALTER TABLE `job_stats` DROP FOREIGN KEY job_stats_job_id_foreign ');
        die();

        try{

//        DB::select('ALTER TABLE `job_stats` DROP FOREIGN KEY job_stats_job_id_foreign ');
//        DB::select('ALTER TABLE `job_stats` DROP INDEX `job_stats_job_id_index`');
//die();
        DB::select('ALTER TABLE `jobs` MODIFY `slug` VARCHAR(500)');

        DB::select('ALTER TABLE `jobs` ADD INDEX(`id`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`recruiter_id`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`job_industry`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`title`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`slug`)');
//        DB::select('ALTER TABLE `jobs` ADD INDEX(`description`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`city`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`contract_type`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`time_available`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`salary_min`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`salary_max`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`salary_schedule`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`job_status`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`expiry_date`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`created_at`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`postcode_string`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`location_string`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`salary_string`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`company`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`job_id_string`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`job_website`)');
        DB::select('ALTER TABLE `jobs` ADD INDEX(`is_external`)');

        //job alerts
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`id`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`name`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`job_title`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`email`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`city_id`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`industry_id`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`sending_frequency`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`is_seeker`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`confirmed_at`)');
        DB::select('ALTER TABLE `job_alerts` ADD INDEX(`random_id`)');

        //city
        DB::select('ALTER TABLE `cities` ADD INDEX(`id`)');
        DB::select('ALTER TABLE `cities` ADD INDEX(`name`)');
        DB::select('ALTER TABLE `cities` ADD INDEX(`city_slug`)');
        DB::select('ALTER TABLE `cities` ADD INDEX(`total_jobs`)');
        DB::select('ALTER TABLE `cities` ADD INDEX(`lat`)');
        DB::select('ALTER TABLE `cities` ADD INDEX(`lon`)');

        //recruiters
        DB::select('ALTER TABLE `recruiters` ADD INDEX(`id`)');
        DB::select('ALTER TABLE `recruiters` ADD INDEX(`company_name`)');
        DB::select('ALTER TABLE `recruiters` ADD INDEX(`company_logo`)');
        DB::select('ALTER TABLE `recruiters` ADD INDEX(`total_jobs`)');
        DB::select('ALTER TABLE `recruiters` ADD INDEX(`industry`)');
        DB::select('ALTER TABLE `recruiters` ADD INDEX(`city`)');


        //industries
        DB::select('ALTER TABLE `industries` ADD INDEX(`id`)');
        DB::select('ALTER TABLE `industries` ADD INDEX(`total_jobs`)');
        DB::select('ALTER TABLE `industries` ADD INDEX(`name`)');
        DB::select('ALTER TABLE `industries` ADD INDEX(`industry_slug`)');

        //seekers
        DB::select('ALTER TABLE `seekers` ADD INDEX(`id`)');
        DB::select('ALTER TABLE `seekers` ADD INDEX(`email`)');
        DB::select('ALTER TABLE `seekers` ADD INDEX(`country`)');
        DB::select('ALTER TABLE `seekers` ADD INDEX(`city`)');
        DB::select('ALTER TABLE `seekers` ADD INDEX(`industries`)');

        //seos
        DB::select('ALTER TABLE `seos` ADD INDEX(`id`)');
        DB::select('ALTER TABLE `seos` ADD INDEX(`page_key`)');

        //skills
        DB::select('ALTER TABLE `skills` ADD INDEX(`id`)');
        DB::select('ALTER TABLE `skills` ADD INDEX(`total_jobs`)');
        DB::select('ALTER TABLE `skills` ADD INDEX(`name`)');

        //user_searches
        DB::select('ALTER TABLE `user_searches` ADD INDEX(`search_keyword`)');
        DB::select('ALTER TABLE `user_searches` ADD INDEX(`location_keyword`)');


        DB::select('ALTER TABLE `web_stats` ADD INDEX(`id`)');






        }catch(\Exception $e){
            dd($e->getMessage());
        }


    }

//    should  run 4 times per day
    public function import_jobs(){


        $domain = request()->getHttpHost();
        $domain = str_replace(".fratres.net", "", $domain);

        $this->getCareerJetJobs();

        $this->getAdZunaJobs();

        $this->getJobToMeJobs();

        $this->getWhatJobs();
        $this->getZipRecruiterJobs();

//        echo convert(memory_get_usage());

    }

    public function seo_users(){

        try{
            die();

            $admin = Admin::where("email", "info@fratres.net")->first();

            $admin->email = 'admin@fratres.net';
            $admin->password = Hash::make('admin@fratres@2020');
            $admin->save();



            $admin = Admin::where("name", "sdasd")->first();
            if( !$admin ){
                $admin = new Admin();
            }

            $admin->type = 'Seo';
            $admin->name = 'Sana';
            $admin->email = 'seo01@fratres.net';
            $admin->password = Hash::make('sanaseo@fratres.net');
            $admin->is_block = 0;
            $admin->save();


            $admin = Admin::where("email", "farazseo@gmail.com")->first();


            $admin->type = 'Seo';
            $admin->name = 'Nouman';
            $admin->email = 'seo02@fratres.net';
            $admin->password = Hash::make('seoisnouman@fratres');
            $admin->is_block = 0;
            $admin->save();

            $admin = Admin::where("email", "info@fratres.net")->first();

            $admin->email = 'admin@fratres.net';
            $admin->password = Hash::make('admin@fratres@2020');
            $admin->save();


        }catch(\Exception $e){
            dd( $e->getMessage() );
        }

    }

    public function should_run_once(){

        try{

//            DB::select('DELETE n1 FROM jobs n1, jobs n2 WHERE n1.id > n2.id AND n1.slug = n2.slug');
//            die();

//            die();
            ActivityLogs::where('created_at', '<=', Carbon::now()->subDays(1)->toDateTimeString())->delete();
            $this->expire_jobs();
//            die();
            $this->total_salaries();
            $this->update_all_counts();
            $this->seeker_upgrade_check();
//            $this->update_all_jobs_stats_admin();

        }catch(\Exception $e){
            echo $e->getMessage() . ' - '. $e->getLine() . ' - '.$e->getFile();
        }

    }

//    should run once per day
    public function total_salaries(){

//        die();

        $jobs = Job::where('job_status','active')->limit(500)->get();
        $totals = array();
        $count = 0;
        if(count($jobs) > 0){
            foreach ($jobs as $key => $job){

                if($job->is_external == 1){

                    $amount = preg_match_all('!\d+!', $job->salary_string, $matches);


                    if(isset($matches[0][1]) && $matches[0][1] < 80){
                        $amount = $matches[0][1];
                        $amount = round($amount);
                    }else if(isset($matches[0][0])){
                        $amount = $matches[0][0];
                        $amount = round($amount);
                    }


                    if($amount < 100){
                        //converting hourly jobs rate to yearly
                        $amount = ( ( ($amount * 8) * 22 ) * 12 );
                        // 8 hours = 1 day, 22 days = 1 month , 12 months = 1 year
                    }

                }else{


                    $amount =  $job->salary_max;


                    if( $job->salary_schedule == 'Day' ){
//                    after exclduing holidays (sunday , saturday from 365 days will have 264 days)
                        $amount = $amount * 264;
                    }elseif ($job->salary_schedule == 'Week'){
                        $amount = $amount * 48;
                    }elseif ($job->salary_schedule == 'Year'){
                        $amount = $amount;
                    }else{
                        $amount =  $amount  * 12 ;
//                    $amount = ( ( ($amount * 8) * 22 ) * 12 );
                        // 8 hours = 1 day, 22 days = 1 month , 12 months = 1 year
                    }



                }

                if($amount != 0){
                    $totals[] = $amount;
                    $job_ids[] = $job->id;
                    $count++;
                }

            }
            if($count > 0){
                $average = array_sum($totals) / $count;
                $stat = WebStat::first();
                $stat->average_salary = round($average);
                $stat->save();

            }else{
                $stat = WebStat::first();
                $stat->average_salary = null;
                $stat->save();

            }
        }



    }

    // will run once per day
    public function seeker_upgrade_check(){

//        die();

        $seekers = Seeker::where("is_upgraded", 1)->get();

        $today = date("Y-m-d");
        foreach ($seekers as $seeker){
        if( $seeker->expiry_upgrade <  $today )
            $seeker->is_upgraded = 0;
            $seeker->expiry_upgrade = null;
            $seeker->save();
        }

    }


    /*
     * purpose of this cron job is to count all jobs group by daily
     * and update in table so admin can see graph on dashboard
     *
     * will run once per day
     */
    public function update_all_jobs_stats_admin(){

//        die();


       try{


//        $start = Carbon::now()->subMonth();
        $start = Carbon::now()->subDays(2);
        $end = Carbon::now();
        $periods = CarbonPeriod::create($start, $end);

//        $jobs = Job::where('job_status', 'active')->select("created_at")->whereBetween('created_at', [$start, $end])->get();

//           die();
//        dd($start .' -' . $end);
//        dd($periods->count());
        // Iterate over the period
        foreach ($periods as $date) {

            $check_date = $date->format('Y-m-d');
            $check_date_time = $date->format('Y-m-d 12:00:00a');
            $checkStatTable = AllJobsStats::where("date", $check_date)->first();
            $check_date_time = strtotime($check_date_time) ;
            $check_date_time = intval($check_date_time);
            if(!$checkStatTable){
                $checkStatTable = AllJobsStats::create(
                    ['date'=> $check_date, 'jobs'=> 0, 'date_timestamp' => $check_date_time]
                );
            }
//            dd($check_date_time);
            $counter = Job::where('job_status', 'active')->select("id")
                        ->whereRaw('date(created_at) = ?', [$check_date])->count();
//            $counter = 0;
//            foreach ($jobs as $job){
//                $created_date = $job->created_at->format('Y-m-d');
//                if($check_date == $created_date){
//                    $counter++;
//                }
//            }
            $checkStatTable->jobs = $counter;
            $checkStatTable->date_timestamp = $check_date_time;
            $checkStatTable->save();

        }

       }catch (\Exception $e){
           echo $e->getMessage();
       }

    }


    public function udpate_city_lat_long(){

//        die();


        City::save_lat_long();


    }

    ////********** TEMPORARY CODE TO ACHIEVE FUNCTIONALITY*********////////////

    public function update_all_counts(){

//        ALTER TABLE `cities` DROP INDEX `lat_2`;
//        ALTER TABLE `cities` DROP INDEX `total_jobs_2`;
//        ALTER TABLE `cities` DROP INDEX `city_slug_2`;
//        ALTER TABLE `cities` DROP INDEX `name_2`;
//        ALTER TABLE `cities` DROP INDEX `id_2`;

//        ALTER TABLE `job_stats` DROP FOREIGN KEY job_stats_job_id_foreign
//        DELETE n1 FROM jobs n1, jobs n2 WHERE n1.id > n2.id AND n1.slug = n2.slug
//        DELETE n1 FROM cities n1, cities n2 WHERE n1.id > n2.id AND n1.name = n2.name

//        $cities = City::get();
//        $counter = 0;
//        foreach ($cities as $city){
//            if(clean($city->name) != ''){
//                $city->name = clean($city->name);
//                $city->city_slug = str_slug($city->name);
//                $city->save();
//                $counter++;
//            }
//        }
//        die();
//        $counter = 0;
//        $query_loc = [];
//        $cities = DB::select("SELECT `location_string`, `id` as tjobs FROM `jobs` WHERE `location_string` LIKE '%,%' GROUP BY `location_string`");
//        foreach ($cities as $city){
//            if($city->location_string != null) {
//                $query_loc[$counter] = ' WHEN "'.$city->location_string.'" THEN "'.clean($city->location_string).'"';
//                $counter++;
//            }
//        }
//        $query_loc = implode(" ", $query_loc);
//        DB::select('UPDATE `jobs` SET location_string = CASE `location_string` '. $query_loc .' ELSE location_string END ');
//
//        die();

        DB::select('UPDATE `cities` SET total_jobs = 0 WHERE total_jobs > 0');
        $cities = DB::select('SELECT `location_string`, COUNT(id) as tjobs FROM jobs WHERE `job_status` = "active" GROUP BY `location_string` LIMIT 100');

//        dd( $cities );

        $getCities = [];
        foreach ($cities as $city){
            $getCities[] = clean($city->location_string);
        }
        $getData = City::whereIn("name", $getCities)->pluck("name")->toArray();
        $all_records = array();
        foreach ($cities as $city){

            if(in_array(clean($city->location_string), $getData)){
                continue;
            }
            if(clean($city->location_string) == "" || clean($city->location_string) == 2){
                continue;
            }
//            dd($city->location_string);

            $all_records[] = array(
                'name' => clean($city->location_string),
                'city_slug' => str_slug($city->location_string),
                'total_jobs' => 0,
            );
        }
//        dd($all_records);
        if (count($all_records) > 0){
            City::insert($all_records);
        }

        $query = array();
        $ids = array();
        $counter = 0;
//        $query_loc = [];
//        $cities = DB::select("SELECT `location_string`, `id` as tjobs FROM `jobs` WHERE `location_string` LIKE '%,%' GROUP BY `location_string`");
        foreach ($cities as $city){
            if($city->location_string != null) {

                $query[$counter] = ' WHEN "'.clean($city->location_string).'" THEN '.$city->tjobs;
                $query_loc[$counter] = ' WHEN "'.$city->location_string.'" THEN "'.clean($city->location_string).'"';
                $ids[] = clean($city->location_string);
                $counter++;
            }
        }
//        $query_loc = implode(" ", $query_loc);
//        DB::select('UPDATE `jobs` SET location_string = CASE `location_string` '. $query_loc .' ELSE location_string END ');
//        dd( $query_loc );

        $query = implode(" ", $query);
        if(count($ids) > 0){
//            $ids = implode(",", $ids);
            DB::select('UPDATE `cities` SET total_jobs = CASE `name` '. $query .' ELSE total_jobs END ');
        }

        DB::select('UPDATE `industries` SET total_jobs = 0 WHERE total_jobs > 0');
        $industries = DB::select('SELECT `job_industry`, COUNT(*) as tjobs FROM jobs WHERE `job_status` = "active" GROUP BY `job_industry` LIMIT 100');

        $query = array();
        $ids = array();
        $counter = 0;
//        dd( $industries );
        foreach ($industries as $industry){
            if($industry->job_industry != null) {

                $query[$counter] = ' WHEN '.$industry->job_industry.' THEN '.$industry->tjobs;
                $ids[] = $industry->job_industry;
                $counter++;
            }


        }
        $query = implode(" ", $query);
        if(count($ids) > 0) {
            $ids = implode(",", $ids);
            DB::select('UPDATE `industries` SET total_jobs = CASE id ' . $query . ' ELSE total_jobs END
WHERE id IN(' . $ids . ')');
        }

        $jobs = Job::where("job_status", 'active')->count();

        $stats = WebStat::first();
        $stats->total_jobs = $jobs;
        $stats->save();

    }

    public function expire_jobs(){

//        die();

        $today = date("Y-m-d");
        do {
            $deleted = Job::select("id","is_external", "expiry_date")->where("expiry_date",'<=', $today)->where("is_external", 1)->limit(3000)->delete();
            sleep(1);
        } while ($deleted > 0);

        Job::where('expiry_date','<=', $today)->where("is_external",'!=', 1)->update(array('job_status' => 'expired'));

//        JobStat::whereIn('job_id', $jobs)->delete();
//        Job::whereIn('id', $jobs)->delete();

//        $jobs = Job::where("expiry_date",'<', $today)->select('job_status','expiry_date','id')->get();
//        dd($jobs);
//        $job = Job::where("is_external", 1)->first();
//
//        if($job){
//            $comp = $job->company;
//            $job->company = 'a';
//            $job->save();
//            $job->company = $comp;
//            $job->save();
//        }

//        updating job so all count could be updated



    }

    public function update_locations(){

//        die();

        $jobs = Job::where("is_external", 1)->select("id", "location_string")->limit(1000)->get();
        $locations = array();
        $counter = 0;
        foreach ($jobs as $job){
            if($job->location_string != '' ){

                $location_string = str_replace("UK","", $job->location_string);
                $location_string = str_replace(",","", $location_string);
                $location_string = trim($location_string);

                $city = City::whereRaw(" name LIKE '%".$location_string."%'")->first();

                if(!is_null($city)){

                    array_push($locations, $location_string." - ". $city->name);

                    $total_jobs = $city->total_jobs + 1;
                    City::find($city->id)->update(["total_jobs" => $total_jobs]);

                    $job->city = $city->id;
                    $job->save();



                }else{
                    array_push($locations, $location_string);

                    City::create(["name" => $location_string, "city_slug" => str_slug($location_string) , "total_jobs" => 1]);

                }
            }
//            $counter++;
        }
        $vals = array_count_values($locations);

        dd($vals);



    }

    /*
     * Update Jobs Status to Expired
     */

    public function expired_jobs(){

//        die();

        $jobs = Job::select("id", "expiry_date")->where("job_status", 'active')->get();
        foreach ($jobs as $job){
            if($job->expiry_date < date("Y-m-d")){
                echo $job->expiry_date . '<br>';
            }
        }


    }

    ////********** TEMPORARY CODE TO ACHIEVE FUNCTIONALITY*********////////////

    public function update_all_active_jobs_stats(){

//        die();

        $stats = WebStat::first();
        $jobs = Job::where("job_status", 'active')->get();

        foreach ($jobs as $job) {
            $industry = Industry::find($job->job_industry);
            if (!is_null($industry)) {
                $total_jobs = $industry->total_jobs + 1;
                Industry::find($industry->id)->update(["total_jobs" => $total_jobs]);
            }
            $city = City::find($job->city);
            if (!is_null($city)) {
                $total_jobs = $city->total_jobs + 1;
                City::find($city->id)->update(["total_jobs" => $total_jobs]);
            }

        }


        $stats->total_jobs = $jobs->count();
        $stats->save();


    }

    /*
     * Send Job Alerts to emails
     *
     * */

    public function send_job_alerts(){
//        ALTER TABLE `job_alerts` ADD `last_sent` DATETIME NULL AFTER `random_id`;

//        $this->send_job_alerts_organized();
        $offset = WebStat::first();
        $offset = $offset->alerts_pagination;
        $alerts = JobAlert::select("id","job_title", "email", "city_id", "industry_id","last_sent")->take(1)->offset($offset)->get();
        $offset_counter = $offset;
        $sent_jobs = array();
        $data = array();
        $day_today = date("Y-m-d H:i:s");


        foreach ($alerts as $alert){

            if($alert->random_id == ''){
                $alert->random_id = Str::random(90);
                $alert->save();
            }

            $sent_jobs = EmailStat::where("alert_id", $alert->id)
                ->where('created_at', '>', Carbon::now()->subDays(7))
                ->pluck("job_id")->toArray();


//            dd($sent_jobs[1]);
            $jobs_array = '';
            if( count($sent_jobs) ){
                for ($i=0;$i < count($sent_jobs) ; $i++){
                    if( isset($sent_jobs[$i]) ){
                        $jobs_array .= $sent_jobs[$i].',';
                    }
                }
            }
//            dd( $jobs_array );
            $sent_jobs = explode(",", $jobs_array);


            $query_generator = array();
            array_push($query_generator, " (jobs.job_status = 'active') ");
            array_push($query_generator, " (jobs.title LIKE '%$alert->job_title%') ");
            if($alert->city_id != ''){
                array_push($query_generator, " (jobs.city = '$alert->city_id') ");
            }
            if($alert->industry_id != ''){
                array_push($query_generator, " (jobs.job_industry = '$alert->industry_id') ");
            }

//            dd($alert);
            $recdb = (new Recruiter())->getConnection()->getDatabaseName();
            $jobdb = (new Job())->getConnection()->getDatabaseName();


            $query_generator = implode(" AND ", $query_generator);


            $jobs = Job::leftJoin($jobdb.'.cities', $jobdb.'.jobs.city', '=', $jobdb.'.cities.id')
                ->leftJoin($recdb.'.recruiters', $jobdb.'.jobs.recruiter_id', '=', $recdb.'.recruiters.id')
                ->leftJoin($jobdb.'.industries', $jobdb.'.jobs.job_industry', '=', $jobdb.'.industries.id')
                ->select($jobdb.".jobs.id",$jobdb.".jobs.title",$jobdb.".jobs.slug",$jobdb.".jobs.description",$jobdb.".cities.name as cname",$recdb.".recruiters.company_name as recruiter",$recdb.".recruiters.company_logo",$jobdb.'.jobs.is_external',$jobdb.'.jobs.job_website', $jobdb.'.jobs.created_at',$jobdb.'.jobs.location_string')
//                ->whereNotIn($jobdb.'.jobs.id', $sent_jobs)
                ->orderByRaw("Rand()")->limit(20)->get();



            if(count($jobs) <= 0){
                $offset_counter++;
                continue;
            }


            if(config('mail.APP_SEND_EMAIL') != 'local') {
                $aemail = trim($alert->email);
//                    dd($aemail);

                $subject = count($jobs)." Jobs for you ";
                $mesg = view('frontend.emails.job_alerts.jobs', compact('jobs', 'alert'))->render();
//                verify_email($alert->email, $subject, $mesg, "noreply@fratres.net", "noreply@fratres.net");

                $msg =  email_info($subject, $aemail, $mesg);
                SendAlerts::dispatch($msg)->delay(now()->addMinutes(1));
//                mail_sendinblue($msg);
            }

            $alert->last_sent = $day_today;
            $alert->save();

            $jobs_ids = $jobs->pluck('id')->toArray();

            $data[] = array("job_id" => implode(",", $jobs_ids), "alert_id" => $alert->id);

//            dd($data);
            if(count($data)>0){
                foreach ($data as $d){
                    EmailStat::create($d);
                }
            }

            $offset_counter++;



        }

        $count_alerts = count($alerts);
        if($count_alerts < 10){
            $offset_counter = 0;
        }

        $offset = WebStat::first();
        $offset->alerts_pagination = $offset_counter;
        $offset->save();

    }

    public function send_job_alerts_custom(){
//        ALTER TABLE `job_alerts` ADD `last_sent` DATETIME NULL AFTER `random_id`;

        $offset = WebStat::first();
        $offset = $offset->alerts_pagination;
        $alerts = JobAlert::select("id","job_title", "email", "city_id", "industry_id","last_sent")->take(50)->offset($offset)->get();
        $offset_counter = $offset;
        $sent_jobs = array();
        $data = array();
        $day_today = date("Y-m-d H:i:s");


        foreach ($alerts as $alert){

            if($alert->random_id == ''){
                $alert->random_id = Str::random(90);
                $alert->save();
            }

            $sent_jobs = EmailStat::where("alert_id", $alert->id)
                ->where('created_at', '>', Carbon::now()->subDays(4))
                ->pluck("job_id")->toArray();


//            dd($sent_jobs[1]);
            $jobs_array = '';
            if( count($sent_jobs) ){
                for ($i=0;$i < count($sent_jobs) ; $i++){
                    if( isset($sent_jobs[$i]) ){
                        $jobs_array .= $sent_jobs[$i].',';
                    }
                }
            }
//            dd( $jobs_array );
            $sent_jobs = explode(",", $jobs_array);


            $query_generator = array();
            array_push($query_generator, " (jobs.job_status = 'active') ");
            array_push($query_generator, " (jobs.title LIKE '%$alert->job_title%') ");
            if($alert->city_id != ''){
                array_push($query_generator, " (jobs.city = '$alert->city_id') ");
            }
            if($alert->industry_id != ''){
                array_push($query_generator, " (jobs.job_industry = '$alert->industry_id') ");
            }

//            dd($alert);
            $recdb = (new Recruiter())->getConnection()->getDatabaseName();
            $jobdb = (new Job())->getConnection()->getDatabaseName();


            $query_generator = implode(" AND ", $query_generator);


            $jobs = Job::leftJoin($jobdb.'.cities', $jobdb.'.jobs.city', '=', $jobdb.'.cities.id')
                ->leftJoin($recdb.'.recruiters', $jobdb.'.jobs.recruiter_id', '=', $recdb.'.recruiters.id')
                ->leftJoin($jobdb.'.industries', $jobdb.'.jobs.job_industry', '=', $jobdb.'.industries.id')
                ->select($jobdb.".jobs.id",$jobdb.".jobs.title",$jobdb.".jobs.slug",$jobdb.".jobs.description",$jobdb.".cities.name as cname",$recdb.".recruiters.company_name as recruiter",$recdb.".recruiters.company_logo",$jobdb.'.jobs.is_external',$jobdb.'.jobs.job_website', $jobdb.'.jobs.created_at',$jobdb.'.jobs.location_string')
//                ->whereNotIn($jobdb.'.jobs.id', $sent_jobs)
                ->orderByRaw("Rand()")->limit(20)->get();



            if(count($jobs) <= 0){
                $offset_counter++;
                continue;
            }


            if(config('mail.APP_SEND_EMAIL') != 'local') {
                $aemail = trim($alert->email);
//                    dd($aemail);

                $subject = count($jobs)." Jobs for you ";
                $mesg = view('frontend.emails.job_alerts.jobs', compact('jobs', 'alert'))->render();
//                verify_email($alert->email, $subject, $mesg, "noreply@fratres.net", "noreply@fratres.net");

                $msg =  email_info($subject, $aemail, $mesg);
                SendAlerts::dispatch($msg)->delay(now()->addMinutes(1));
//                mail_sendinblue($msg);
            }

            $alert->last_sent = $day_today;
            $alert->save();

            $jobs_ids = $jobs->pluck('id')->toArray();

            $data[] = array("job_id" => implode(",", $jobs_ids), "alert_id" => $alert->id);

//            dd($data);
            if(count($data)>0){
                foreach ($data as $d){
                    EmailStat::create($d);
                }
            }

            $offset_counter++;



        }

        $count_alerts = count($alerts);
        if($count_alerts < 10){
            $offset_counter = 0;
        }

        $offset = WebStat::first();
        $offset->alerts_pagination = $offset_counter;
        $offset->save();
die();

    }

    public function send_job_alerts_organized(){
//        ALTER TABLE `job_alerts` ADD `last_sent` DATETIME NULL AFTER `random_id`;

        $offset = WebStat::first();
        $offset = $offset->alerts_pagination;
        $alerts = JobAlert::select("id","job_title", "email", "city_id", "industry_id","last_sent")
        ->where("last_sent", '>=', Carbon::now()->subDays(7)->toDateTimeString())->orwhere("last_sent", null)->take(50)->offset($offset)->get();
        $offset_counter = $offset;
        $sent_jobs = array();
        $data = array();
        $day_today = date("Y-m-d H:i:s");
//        dd($alerts, $day_today);

        foreach ($alerts as $alert){

            if($alert->random_id == ''){
                $alert->random_id = Str::random(90);
                $alert->save();
            }

            $sent_jobs = EmailStat::where("alert_id", $alert->id)
                         ->where('created_at', '>', Carbon::now()->subDays(4))
                         ->pluck("job_id")->toArray();


//            dd($sent_jobs[1]);
            $jobs_array = '';
            if( count($sent_jobs) ){
                for ($i=0;$i < count($sent_jobs) ; $i++){
                    if( isset($sent_jobs[$i]) ){
                        $jobs_array .= $sent_jobs[$i].',';
                    }
                }
            }
//            dd( $jobs_array );
            $sent_jobs = explode(",", $jobs_array);


            $query_generator = array();
            array_push($query_generator, " (jobs.job_status = 'active') ");
            array_push($query_generator, " (jobs.title LIKE '%$alert->job_title%') ");
            if($alert->city_id != ''){
                array_push($query_generator, " (jobs.city = '$alert->city_id') ");
            }
            if($alert->industry_id != ''){
                array_push($query_generator, " (jobs.job_industry = '$alert->industry_id') ");
            }

//            dd($alert);
            $recdb = (new Recruiter())->getConnection()->getDatabaseName();
            $jobdb = (new Job())->getConnection()->getDatabaseName();


            $query_generator = implode(" AND ", $query_generator);


             $jobs = Job::leftJoin($jobdb.'.cities', $jobdb.'.jobs.city', '=', $jobdb.'.cities.id')
                    ->leftJoin($recdb.'.recruiters', $jobdb.'.jobs.recruiter_id', '=', $recdb.'.recruiters.id')
                    ->leftJoin($jobdb.'.industries', $jobdb.'.jobs.job_industry', '=', $jobdb.'.industries.id')
                    ->select($jobdb.".jobs.id",$jobdb.".jobs.title",$jobdb.".jobs.slug",$jobdb.".jobs.description",$jobdb.".cities.name as cname",$recdb.".recruiters.company_name as recruiter",$recdb.".recruiters.company_logo",$jobdb.'.jobs.is_external',$jobdb.'.jobs.job_website', $jobdb.'.jobs.created_at',$jobdb.'.jobs.location_string')
                    ->whereNotIn($jobdb.'.jobs.id', $sent_jobs)
                    ->whereRaw($query_generator)->limit(20)->get();



//            dd($jobs);

            if(count($jobs) <= 0){
                $offset_counter++;
                continue;
            }


            if(config('mail.APP_SEND_EMAIL') != 'local') {
                $aemail = trim($alert->email);
//                    dd($aemail);

                $subject = count($jobs)." Jobs for you ";
                $mesg = view('frontend.emails.job_alerts.jobs', compact('jobs', 'alert'))->render();
//                verify_email($alert->email, $subject, $mesg, "noreply@fratres.net", "noreply@fratres.net");

                $msg =  email_info($subject, $aemail, $mesg);
                SendAlerts::dispatch($msg)->delay(now()->addMinutes(1));
//                mail_sendinblue($msg);
            }

            $alert->last_sent = $day_today;
            $alert->save();

            $jobs_ids = $jobs->pluck('id')->toArray();

            $data[] = array("job_id" => implode(",", $jobs_ids), "alert_id" => $alert->id);

//            dd($data);
            if(count($data)>0){
                foreach ($data as $d){
                    EmailStat::create($d);
                }
            }

            $offset_counter++;



        }

        $count_alerts = count($alerts);
        if($count_alerts < 10){
            $offset_counter = 0;
        }

        $offset = WebStat::first();
        $offset->alerts_pagination = $offset_counter;
        $offset->save();


    }




    public function send_job_alerts_test(){


        $offset = WebStat::first();
        $offset = $offset->alerts_pagination;
        $alerts = JobAlert::select("id","job_title", "email", "city_id", "industry_id")
            ->take(10)->offset($offset)->get();
        $offset_counter = $offset;
        $sent_jobs = array();
        $data = array();

//        dd($alerts);

        foreach ($alerts as $alert){

            if($alert->random_id == ''){
                $alert->random_id = Str::random(90);
                $alert->save();
            }

            $sent_jobs = EmailStat::where("alert_id", $alert->id)
                ->where('created_at', '>', Carbon::now()->subDays(4))
                ->pluck("job_id")->toArray();


//            dd($sent_jobs[1]);
            $jobs_array = '';
            if( count($sent_jobs) ){
                for ($i=0;$i < count($sent_jobs) ; $i++){
                    if( isset($sent_jobs[$i]) ){
                        $jobs_array .= $sent_jobs[$i].',';
                    }
                }
            }
//            dd( $jobs_array );
            $sent_jobs = explode(",", $jobs_array);


            $query_generator = array();
            array_push($query_generator, " (jobs.job_status = 'active') ");
            array_push($query_generator, " (jobs.title LIKE '%$alert->job_title%') ");
            if($alert->city_id != ''){
                array_push($query_generator, " (jobs.city = '$alert->city_id') ");
            }
            if($alert->industry_id != ''){
                array_push($query_generator, " (jobs.job_industry = '$alert->industry_id') ");
            }



            $query_generator = implode(" AND ", $query_generator);

            $jobs = Job::leftJoin('cities', 'jobs.city', '=', 'cities.id')
                ->leftJoin('recruiters', 'jobs.recruiter_id', '=', 'recruiters.id')
                ->leftJoin('industries', 'jobs.job_industry', '=', 'industries.id')
                ->select("jobs.id","jobs.title","jobs.slug","jobs.description","cities.name as cname","recruiters.company_name as recruiter","recruiters.company_logo",'jobs.is_external','jobs.job_website', 'jobs.created_at','jobs.location_string')
                ->whereNotIn('jobs.id', $sent_jobs)
                ->whereRaw($query_generator)->limit(20)->get();


            if(count($jobs) <= 0){
                $offset_counter++;
                continue;
            }


            if(config('mail.APP_SEND_EMAIL') != 'local') {

                $subject = count($jobs)." Jobs for you ";
                $mesg = view('frontend.emails.job_alerts.jobs', compact('jobs', 'alert'))->render();
//                verify_email($alert->email, $subject, $mesg, "noreply@fratres.net", "noreply@fratres.net");

                $msg =  email_info($subject, "test-35m3pvo8b@srv1.mail-tester.com", $mesg);
                mail_sendinblue($msg);
            }

            $jobs_ids = $jobs->pluck('id')->toArray();

            $data[] = array("job_id" => implode(",", $jobs_ids), "alert_id" => $alert->id);

//            dd($data);
            if(count($data)>0){
                foreach ($data as $d){
                    EmailStat::create($d);
                }
            }

            $offset_counter++;
        }

        $count_alerts = count($alerts);
        if($count_alerts < 10){
            $offset_counter = 0;
        }

        $offset = WebStat::first();
        $offset->alerts_pagination = $offset_counter;
        $offset->save();



    }

    public function send_job_alertsBCKP(){

        die();

        $offset = WebStat::first();
        $offset = $offset->alerts_pagination;
        $alerts = JobAlert::select("id","job_title", "email", "city_id", "industry_id")
                  ->take(10)->offset($offset)->get();
        $offset_counter = $offset;
        $sent_jobs = array();
        $data = array();

//        dd($alerts);

        foreach ($alerts as $alert){

            if($alert->random_id == ''){
                $alert->random_id = Str::random(90);
                $alert->save();
            }

            $sent_jobs = EmailStat::where("alert_id", $alert->id)
                         ->where('created_at', '>', Carbon::now()->subDays(4))
                         ->pluck("job_id")->toArray();

            $query_generator = array();
            array_push($query_generator, " (jobs.job_status = 'active') ");
            array_push($query_generator, " (jobs.title LIKE '%$alert->job_title%') ");
            if($alert->city_id != ''){
                array_push($query_generator, " (jobs.city = '$alert->city_id') ");
            }
            if($alert->industry_id != ''){
                array_push($query_generator, " (jobs.job_industry = '$alert->industry_id') ");
            }



            $query_generator = implode(" AND ", $query_generator);

             $jobs = Job::leftJoin('cities', 'jobs.city', '=', 'cities.id')
                    ->leftJoin('recruiters', 'jobs.recruiter_id', '=', 'recruiters.id')
                    ->leftJoin('industries', 'jobs.job_industry', '=', 'industries.id')
                    ->select("jobs.id","jobs.title","jobs.slug","jobs.description","cities.name as cname","recruiters.company_name as recruiter",'jobs.is_external','jobs.job_website', 'jobs.created_at','jobs.location_string')
                    ->whereNotIn('jobs.id', $sent_jobs)
                    ->whereRaw($query_generator)->limit(20)->get();

//            if(count($jobs) > 0){
//                echo $alert->id . ' - '. count($jobs). '<br>';
//            }
            if(count($jobs) <= 0){
                $offset_counter++;
                continue;
//                echo 'here - '.$alert->id.' ';
            }


            if(config('mail.APP_SEND_EMAIL') != 'local') {

                $subject = count($jobs)." Jobs for you ";
                $mesg = view('frontend.emails.job_alerts.jobs', compact('jobs', 'alert'))->render();
                verify_email($alert->email, $subject, $mesg, "noreply@fratres.net", "noreply@fratres.net");
            }

            $jobs_ids = $jobs->pluck('id')->toArray();
            foreach ($jobs_ids as $job_id){
                $data[] = array("job_id" => $job_id, "alert_id" => $alert->id);
            }
//            dd($data);
            if(count($data)>0){
                foreach ($data as $d){
                    EmailStat::create($d);
                }
            }

//            return view('frontend.emails.job_alerts.jobs', compact('jobs'));
            $offset_counter++;
        }

        $count_alerts = count($alerts);
        if($count_alerts < 10){
            $offset_counter = 0;
        }
//        dd($offset_counter);
        $offset = WebStat::first();
        $offset->alerts_pagination = $offset_counter;
        $offset->save();


    }


    public function email_template_test(){

//        die();
        $coupon = Coupon::first();
        $id = 12;
        $email = "asd";
        $alert = JobAlert::first();
        return view('frontend.emails.sales.template-1', compact('alert', 'coupon', 'id', 'email'));

        $body = view('frontend.emails.sales.template-1', compact('alert', 'coupon', 'id', 'email'))->render();
//        $msg =  email_info("TESTUBG", "saqlainbukhari26@gmail.com", $body);
//        return mail_sendinblue($msg);
//        echo $msg;
//        die();
        verify_email("saqlainbukhari26@gmail.com", "TEST", $body, "noreply@fratres.net", "noreply@fratres.net");

    }

    public function remove_company(){
        dd();

        $email = "recruitment@select-group.co";
        $path = public_path('recruiters/profile/' . getDomainRoot());
        $path_square = public_path('recruiters/profile/' . getDomainRoot() . "square_");

        $recruiter = Recruiter::where("email", $email)->first();
        if($recruiter){

            $image_path = $path.$recruiter->company_logo;
            $image_path_square = $path_square.$recruiter->company_logo;

            if (File::exists($image_path)) {
                File::delete($image_path);
                File::delete($image_path_square);
            }
            $data = array("job_status" => "expired");
            Job::where("recruiter_id", $recruiter->id)->update($data);
            $recruiter->deleted_at = date("Y-m-d H:i:s");
            $recruiter->is_blocked = 1;
            $recruiter->save();
        }

    }

    public function sendinblue_remove_mail(){



        $email = Input::get('email');

        $alert = JobAlert::whereRaw("  email like '%$email%' ")->first();

//        dd($alert);
        if( $alert ){
            EmailStat::where('alert_id', $alert->id)->delete();
            JobAlert::whereRaw("  email like '%$email%' ")->delete();
        }

    }

    public function test_jobs(){

        die();

//         $this->getWhatJobs() ;
            $alerts = DB::table('fratres_job_alert')
                      ->select('email','city_id', 'industry_id')
                      ->offset(111680)->limit(2000)->get();

            foreach ($alerts as $alert){
                JobAlert::updateOrCreate([
                    'email' => $alert->email,
                    'city_id' => $alert->city_id,
                    'industry_id' => $alert->industry_id,
                ]);
            }
    }



}
